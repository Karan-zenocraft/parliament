<?php
namespace frontend\controllers;

use common\models\LoginForm;
use common\models\Questions;
use common\models\Users;
use frontend\components\FrontCoreController;
use frontend\models\ContactForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * Site controller
 */
class SiteController extends FrontCoreController
{
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        return parent::beforeAction($action);
    }
    /**
     * {@inheritdoc}
     */

    /**
     * {@inheritdoc}
     */
    /* public function actions()
    {
    return [
    'error' => [
    'class' => 'yii\web\ErrorAction',
    ],
    'captcha' => [
    'class' => 'yii\captcha\CaptchaAction',
    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
    ],
    ];
    }*/
    public function actionIndex()
    {
        $this->layout = "homefeed";
        $requestData = Yii::$app->request->get();
        $where = [];
        $dir = (!empty($requestData['sortdir']) && $requestData['sortdir'] == 'asc') ? SORT_ASC : SORT_DESC;
        $orderBy = ['answer_count' => SORT_DESC, 'comment_count' => SORT_DESC, 'share_count' => SORT_DESC];

        if (!empty($requestData['sortby'])) {
            if ($requestData['sortby'] == 'age') {
                $orderBy = ["users.age" => $dir];
            } else if ($requestData['sortby'] == 'sex') {
                $orderBy = ["users.gender" => $dir];
            } else if ($requestData['sortby'] == 'city') {
                $orderBy = ["users.city" => $dir];
            }
        }
        //p($orderBy);
        $model = new Questions();
        /* $mpArr = Users::find()
        ->select(['user_name as value', 'id as id'])
        ->where(['role_id' => Yii::$app->params['userroles']['MP'], "status" => Yii::$app->params['user_status_value']['active']])
        ->asArray()
        ->all();*/
        $mpArr = ArrayHelper::map(Users::find()->orderBy('user_name')->asArray()->all(), 'id', 'user_name');
        //p($mpArr);
        $query = Users::find()
            ->joinWith(['answers', 'comments', 'shares'])
            ->select(['users.*', 'COUNT(answers.id) AS answer_count', 'COUNT(comments.id) AS comment_count', 'COUNT(shares.id) AS share_count'])
            ->where(['users.role_id' => Yii::$app->params['userroles']['MP'], "users.status" => Yii::$app->params['user_status_value']['active']]);
        if (!empty($requestData['search'])) {
            $query = $query->where("users.user_name LIKE '%" . $requestData['search'] . "%'");
        }

        $query = $query->groupBy(['users.id'])
            ->orderBy($orderBy);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $postData = Yii::$app->request->post();
            $model->user_agent_id = Yii::$app->user->id;
            $model->mp_id = implode(",", $postData['Questions']['mp_id']);
            $model->save();
            // Yii::$app->session->setFlash('success', Yii::getAlias('@question_add_message'));
            return ActiveForm::validate($model);
        } else {
            $errors = $model->errors;
            if (!empty($errors) && !empty($errors['question'][0])) {
                Yii::$app->session->setFlash('message', $errors['question'][0]); // its dislplays error msg on
            }
            if (!empty($errors) && !empty($errors['mp_id'][0])) {
                Yii::$app->session->setFlash('message', $errors['mp_id'][0]); // its dislplays error msg on
            }

        }
        $questions = Questions::find()->with('mp', 'userAgent')->asArray()->all();

        return $this->render('index', [
            'model' => $model,
            'questions' => $questions,
            'mp' => $mpArr,
            'models' => $models,
            'pagination' => $pagination,
            'errors' => $errors,
        ]);
    }
    /**
     * Displays homepage.
    v  hbb                                    bbbbbbc      *
     * @return mixed
     */
    public function actionIndex_old()
    {
        $model = new Questions();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->user_agent_id = Yii::$app->user->id;
            $model->mp_id = 2;
            $model->save();
            // Yii::$app->session->setFlash('success', Yii::getAlias('@question_add_message'));
            return $this->redirect(['site/index', 'model' => $model]);
        }
        $questions = Questions::find()->with('mp', 'userAgent')->asArray()->all();

        return $this->render('index', [
            'model' => $model,
            'questions' => $questions,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout = "landingpage";

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect(['site/login']);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model,
        ]);
    }
    public function actionEngagement()
    {
        p(1323);
    }

    public function actionCurrentCity()
    {
        if (!empty($_POST)) {

            $requestData = Yii::$app->request->post();
            $dir = (!empty($requestData['sortdir']) && $requestData['sortdir'] == 'asc') ? SORT_ASC : SORT_DESC;
            $orderBy = ['user_name' => SORT_ASC];

            if (!empty($requestData['sortby'])) {
                if ($requestData['sortby'] == 'age') {
                    $orderBy = ["users.age" => $dir];
                } else if ($requestData['sortby'] == 'sex') {
                    $orderBy = ["users.gender" => $dir];
                } else if ($requestData['sortby'] == 'city') {
                    $orderBy = ["users.city" => $dir];
                }
            }
            $page = $requestData['page'] * 3;
            //p($requestData);
            $query = Users::find()
                ->select(['users.*'])
                ->where(['users.role_id' => Yii::$app->params['userroles']['MP'], "users.status" => Yii::$app->params['user_status_value']['active']]);

            if (!empty($requestData['search'])) {
                $query = $query->where("users.user_name LIKE '%" . $requestData['search'] . "%'");
            }
            $query = $query->orderBy($orderBy);
            $totalCount = $query->count();
            $models = $query->offset($page)
                ->limit(3)
                ->all();

            $retData = "<div class='Row1 col-md-12 d-flex align-items-center justify-content-start'>";
            if (!empty($models)) {
                $numOfCols = 3;
                $rowCount = 0;
                foreach ($models as $key => $value) {
                    $retData .= "<div class='RowBox d-flex align-items-center justify-content-start'><div class='DimmerBox'>";
                    $retData .= "<img src=" . Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png class='img-fluid SliderImage'></div><a href='#'><div class='RowTitle'><p>" . $value['user_name'] . "</p><p><span>" . $value['standing_commitee'] . "<br>Standing Committee</span></p></div></a></div>";
                    $rowCount++;
                    if ($rowCount % $numOfCols == 0) {
                        $retData .= "</div><div class='Row1 col-md-12 d-flex align-items-center justify-content-start'>";
                    }
                }
                $retData .= " </div></div></div></div>";
                // $retData .= \yii\widgets\LinkPager::widget([
                //     'pagination' => $pagination,
                //     'prevPageLabel' => '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>',
                //     'maxButtonCount' => 0,
                //     'options' => ['class' => 'prev_button carousel-control-prev'],
                // ]);
                // $retData .= \yii\widgets\LinkPager::widget([
                //     'pagination' => $pagination,
                //     'nextPageLabel' => '<span class="carousel-control-next-icon" aria-hidden="true"></span>',
                //     'maxButtonCount' => 0,
                //     'options' => ['class' => 'carousel-control-next'],
                // ]);

            } else {
                $retData .= "No Data Found";
            }
            return json_encode($retData);
        }
    }
}
