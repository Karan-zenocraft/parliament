<?php
namespace frontend\controllers;

use common\components\Common;
use common\models\Answers;
use common\models\ChangePasswordForm;
use common\models\Comments;
use common\models\EmailFormat;
use common\models\LoginForm;
use common\models\Notifications;
use common\models\QuestionHide;
use common\models\QuestionReported;
use common\models\Questions;
use common\models\Shares;
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
            } else {
                $orderBy = ['answer_count' => SORT_DESC, 'comment_count' => SORT_DESC, 'share_count' => SORT_DESC];
            }
        }
        $model = new Questions();
        /* $mpArr = Users::find()
        ->select(['user_name as value', 'id as id'])
        ->where(['role_id' => Yii::$app->params['userroles']['MP'], "status" => Yii::$app->params['user_status_value']['active']])
        ->asArray()
        ->all();*/
        $mpArr = ArrayHelper::map(Users::find()->where(['role_id' => Yii::$app->params['userroles']['MP']])->orderBy('name')->asArray()->all(), 'id', 'name');
        //p($mpArr);
        $query = Users::find()
            ->joinWith(['answers', 'comments', 'shares'])
            ->select(['users.*', 'COUNT(answers.id) AS answer_count', 'COUNT(comments.id) AS comment_count', 'COUNT(shares.id) AS share_count'])
            ->where(['users.role_id' => Yii::$app->params['userroles']['MP'], "users.status" => Yii::$app->params['user_status_value']['active']]);
        if (!empty($requestData['search'])) {
            $query = $query->where("users.name LIKE '%" . $requestData['search'] . "%'");
        }

        $query = $query->groupBy(['users.id'])
            ->orderBy($orderBy);
        $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 12]);
        $totalCount = $pagination->totalCount;
        $pageSize = $pagination->pageSize;
        $total_pages = ceil($totalCount / $pageSize);
        //p($pagination);

        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
/*        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
Yii::$app->response->format = Response::FORMAT_JSON;
$postData = Yii::$app->request->post();
$model->user_agent_id = Yii::$app->user->id;
$model->mp_id = implode(",", $postData['Questions']['mp_id']);

if ($model->save()) {
$user_agent_name = $model->userAgent->user_name;
foreach ($postData['Questions']['mp_id'] as $key => $mp) {
$mp_user = Common::get_name_by_id($mp, "Users");
if (!empty($mp_user)) {
//p($mp_user['email']);
$mp_email = $mp_user['email'];
$mp_username = $mp_user['user_name'];
$question = $model->question;
$user_agent_email = $model->userAgent->email;
$emailformatemodel = EmailFormat::findOne(["title" => 'ask_question', "status" => '1']);
if ($emailformatemodel) {

//create template file
$AreplaceString = array('{mp_username}' => $mp_username, '{question}' => $question, '{user_agent_name}' => $user_agent_name);
$body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);

//send email for new generated password
Common::sendMailToUser($mp_email, $user_agent_email, $emailformatemodel->subject, $body);
}
}
}
$title = $user_agent_name . " has asked you a Question.";
$this->actionPubnub($title, $model->mp_id);
};
return $this->redirect(['site/index']);
//return ActiveForm::validate($model);
} else {
$errors = $model->errors;
if (!empty($errors) && !empty($errors['question'][0])) {
Yii::$app->session->setFlash('message', $errors['question'][0]); // its dislplays error msg on
}
if (!empty($errors) && !empty($errors['mp_id'][0])) {
Yii::$app->session->setFlash('message', $errors['mp_id'][0]); // its dislplays error msg on
}

}*/

        //$questions = Questions::find()->with('mp', 'userAgent')->asArray()->all();
        $questionsQuery = Questions::find()->with('userAgent')->where(["status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0])->orderBy(["id" => SORT_DESC]);
        $paginationQuestion = new Pagination(['totalCount' => $questionsQuery->count(), 'pageSize' => 5]);
        $totalCountQuestions = $paginationQuestion->totalCount;
        $pageSizeQuestions = $paginationQuestion->pageSize;
        $total_pages_questions = ceil($totalCountQuestions / $pageSizeQuestions);
        $modelsQuestions = $questionsQuery->offset($paginationQuestion->offset)
            ->limit($paginationQuestion->limit)
            ->all();
        return $this->render('index', [
            'model' => $model,
            // 'questions' => $questions,
            'mp' => $mpArr,
            'models' => $models,
            'pagination' => $pagination,
            //'errors' => $errors,
            'total_pages' => $total_pages,
            'modelsQuestions' => $modelsQuestions,
            'paginationQuestion' => $paginationQuestion,
            'total_pages_questions' => $total_pages_questions,
        ]);
    }

    public function actionPubnub($title, $userid)
    {

        //  var usersN=message.message.userid;
        // var title =message.message.title;
        // if(usersN.includes("loginid"))
        // {

        echo '
        <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.js"></script>
        <script>
            pubnub = new PubNub({
            publishKey: "pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a",
            subscribeKey: "sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20",
        });

                pubnub.addListener({
        status: function(statusEvent) {
            if (statusEvent.category === "PNConnectedCategory") {
                var publishConfig = {
            channel : "rutusha",
            message: {
                title: "' . $title . '",
                description: "hello world!",
                userid: "' . $userid . '",
                flag:true,
                site:"ask.zenocraft.com"
            }
        }
        pubnub.publish(publishConfig, function(status, response) {
            console.log(status, response);
            window.location.href="site/index";
        })
            }
        },
        message: function(msg) {
            console.log(msg.message.title);
            console.log(msg.message.description);
        },
        presence: function(presenceEvent) {
            // handle presence
        }
    })
    console.log("Subscribing..");
    pubnub.subscribe({
        channels: ["rutusha"]
    });

        </script>';
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
        $this->layout = "forgot_password";

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
        $this->layout = "forgot_password";
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

    public function actionCurrentCity()
    {
        if (!empty($_POST)) {

            $requestData = Yii::$app->request->post();
            $dir = (!empty($requestData['sortdir']) && $requestData['sortdir'] == 'asc') ? SORT_ASC : SORT_DESC;
            $orderBy = ['name' => SORT_ASC];

            if (!empty($requestData['sortby'])) {
                if ($requestData['sortby'] == 'age') {
                    $orderBy = ["users.age" => $dir];
                } else if ($requestData['sortby'] == 'sex') {
                    $orderBy = ["users.gender" => $dir];
                } else if ($requestData['sortby'] == 'city') {
                    $orderBy = ["users.city" => $dir];
                }
            }
            if (empty($requestData['sortby']) && empty($requestData['search'])) {
                $orderBy = ['answer_count' => SORT_DESC, 'comment_count' => SORT_DESC, 'share_count' => SORT_DESC];
            }
            $page = ($requestData['page'] - 1) * 12;
            // $page = 12;
            if (empty($requestData['sortby']) && empty($requestData['search'])) {
                $query = Users::find()
                    ->joinWith(['answers', 'comments', 'shares'])
                    ->select(['users.*', 'COUNT(answers.id) AS answer_count', 'COUNT(comments.id) AS comment_count', 'COUNT(shares.id) AS share_count'])
                    ->where(['users.role_id' => Yii::$app->params['userroles']['MP'], "users.status" => Yii::$app->params['user_status_value']['active']]);
                $query = $query->groupBy(['users.id'])
                    ->orderBy($orderBy);

            } else {
                $query = Users::find()
                    ->select(['users.*'])
                    ->where(['users.role_id' => Yii::$app->params['userroles']['MP'], "users.status" => Yii::$app->params['user_status_value']['active']]);

                if (!empty($requestData['search'])) {
                    $query = $query->where("users.name LIKE '%" . $requestData['search'] . "%'");
                }
                $query = $query->orderBy($orderBy);
            }
            $totalCount = $query->count();
            $models = $query->offset($page)
                ->limit(12)
                ->all();
            $retData = "<div class='Row1 col-md-12 d-flex align-items-center justify-content-start'>";
            if (!empty($models)) {
                $numOfCols = 3;
                $rowCount = 0;
                foreach ($models as $key => $value) {
                    $retData .= "<div class='RowBox d-flex align-items-center justify-content-start col-md-4 p-0'><div class='DimmerBox' id=" . "mp_" . $value['id'] . ">";
                    $user_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png";
                    $retData .= "<img src=" . $user_image . " class='img-fluid rounded-circle  SliderImage'></div><a href='#'><div class='RowTitle'><p>" . $value['name'] . "</p><p><span>" . $value['standing_commitee'] . "<br>Standing Committee</span></p></div></a></div>";
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
                $retData .= "No records found";
            }
            return json_encode($retData);
        }
    }
    public function actionMakeLouder()
    {
        $question_id = $_POST['question_id'];
        if (!empty($_POST['event'])) {
            $question = Questions::find()->where(['id' => $question_id, 'status' => Yii::$app->params['user_status_value']['active']])->one();

            if ($_POST['event'] == "like") {
                if (!empty($question->louder_by)) {
                    $checkArray = explode(',', $question->louder_by);
                    if (!in_array(Yii::$app->user->id, $checkArray)) {
                        array_push($checkArray, Yii::$app->user->id);
                        $question->louder_by = implode(',', $checkArray);
                    }
                } else {
                    $question->louder_by = Yii::$app->user->id;
                }
                $question->save(false);
                $louderCount = (empty($question->louder_by) || ($question->louder_by == "")) ? "1" : count(explode(",", $question->louder_by));
                $event = "like";

            } else {
                $louder_by = explode(",", $question->louder_by);
                if (in_array(Yii::$app->user->id, $louder_by)) {
                    unset($louder_by[array_search(Yii::$app->user->id, $louder_by)]);
                }
                $question->louder_by = implode(",", $louder_by);
                $question->save(false);
                $louderCount = (empty($question->louder_by) || ($question->louder_by == "")) ? 0 : count(explode(",", $question->louder_by));
                $event = "unlike";
            }
            $data = ["event" => $event, "louderCount" => $louderCount, "louder_by" => Common::get_user_name(Yii::$app->user->id), "ask_user_id" => $question->user_agent_id, "louder_user_id" => Yii::$app->user->id];
            if (Yii::$app->user->id != $question->user_agent_id) {
                $model_notification = new Notifications();
                $model_notification->user_id = $question->user_agent_id;
                $model_notification->notification = Common::get_user_name(Yii::$app->user->id) . " make louder on your question ";
                $model_notification->save(false);
            }

            return json_encode($data);

        }
    }
    public function actionLoadMoreQuestions()
    {
        if (!empty($_POST['page'])) {
            $loginId = $_POST['user_id'];
            $page = ($_POST['page'] - 1) * 5;
            $flagCond = !empty($_POST['filter']) ? $_POST['filter'] : "";
            $flagCond2 = !empty($_POST['filter2']) ? $_POST['filter2'] : "";
            $flagSearch = !empty($_POST['search']) ? $_POST['search'] : "";

            $questionsQuery = Questions::find()
                ->select(["questions.*", "questions.id", "IF(louder_by,LENGTH(louder_by) - LENGTH(REPLACE(louder_by, ',','')) + 1,0) AS louder_count"])
                ->with(['userAgent', 'answers' => function ($q) {
                    return $q->orderBy(["answers.id" => SORT_DESC]);
                }, 'comments' => function ($q) {
                    return $q->orderBy(["comments.id" => SORT_DESC]);
                }]);
            $user_role_id = Common::get_user_role($loginId, "");
            if ($flagCond == 'myQue') {
                // GET LOGIN USER'S QUESTIONS
                $questionsQuery = $questionsQuery->where(['user_agent_id' => $loginId]);
            } elseif ($flagCond == 'myLouder') {
                // GET LOGIN USER'S LOUDER QUESTIONS
                $questionsQuery = $questionsQuery->andwhere(new \yii\db\Expression('FIND_IN_SET(' . $loginId . ',louder_by)'));
            } elseif ($flagCond == 'mpNotAns') {
                // GET LOGIN USER'S LOUDER QUESTIONS
                $questionsQuery = $questionsQuery->andwhere(new \yii\db\Expression('FIND_IN_SET(' . $loginId . ',questions.mp_id)'));
                $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) use ($loginId) {
                    return $query->andWhere("answers.id is null");
                }]);
            } elseif ($flagCond == 'Answered') {
                // GET LOGIN USER'S ANSWERED QUESTIONS
                // if ($user_role_id == Yii::$app->params['userroles']['user_agent']) {
                // $questionsQuery = $questionsQuery->andwhere(['user_agent_id' => $loginId]);
                $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                    return $query->andWhere("answers.id is not null");
                }]);
                $questionsQuery->groupBy(['answers.question_id']);
                /*   } else {
            $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) use ($loginId) {
            return $query->andWhere(["answers.mp_id" => $loginId]);
            }]);
            }*/

            } elseif ($flagCond == 'Unanswered') {
                // GET LOGIN USER'S UNANSWERED QUESTIONS
                // if ($user_role_id == Yii::$app->params['userroles']['user_agent']) {
                //$questionsQuery = $questionsQuery->andwhere(['user_agent_id' => $loginId]);
                $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                    return $query->andWhere("answers.id is null");
                }]);
                /* } else {
            $questionsQuery = $questionsQuery->andwhere(new \yii\db\Expression('FIND_IN_SET(' . $loginId . ',questions.mp_id)'));
            $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
            return $query->andWhere("answers.id is null");
            }]);
            }*/

            } elseif (($flagCond == 'Homefeed')) {
                $questionsQuery;
            } elseif (($flagCond == 'profile')) {
                if ($user_role_id == Yii::$app->params['userroles']['user_agent']) {
                    $questionsQuery = $questionsQuery->andwhere(['user_agent_id' => $loginId]);
                } else {
                    $questionsQuery->andwhere(new \yii\db\Expression('FIND_IN_SET(' . $loginId . ',questions.mp_id)'));
                }
            }
            if (!empty($flagSearch)) {
                // SEARCH QUESTIONS
                $questionsQuery = $questionsQuery->andwhere(['like', 'question', $flagSearch]);
            }
            $questionHided = QuestionHide::find()->select('question_id')->where("user_id ='" . $loginId . "'")->one();
            $hiddenQuestions = !empty($questionHided) ? $questionHided['question_id'] : "";
            //$questionsQuery = $questionsQuery->orderBy(["id" => SORT_DESC]);
            if (!empty($hiddenQuestions)) {
                $questionsQuery->andWhere("questions.id NOT IN (" . $hiddenQuestions . ")");
            }
            $questionsQuery = $questionsQuery->andWhere("questions.is_delete != '1'");
            //->groupBy("id")
            if ($flagCond2 == 'loudest') {
                //$questionsQuery = $questionsQuery->select(["*", "questions.id", "(LENGTH(louder_by) - LENGTH(REPLACE(louder_by, ',','')) + 1) AS louder_count"]);
                $questionsQuery = $questionsQuery->orderBy(["louder_count" => SORT_DESC]);
            } else {
                $questionsQuery->orderBy(['questions.id' => SORT_DESC, "louder_count" => SORT_DESC]);
            }

            $models = $questionsQuery
                ->offset($page)
                ->limit(5)
                ->all();
            //p($models);
            if (!empty($models)) {
                $pageDataAjax = $this->renderPartial('questions', array(
                    'modelsQuestions' => $models,
                ));
            } else {
                $pageDataAjax = "<span class='no_record'>No more records found.</span>";
            }
        } else {
            $pageDataAjax = "Bad Request, Please try again.";
        }
        $retArray = array('data' => $pageDataAjax, 'count' => count($models), 'page' => $_POST['page']);
        return json_encode($retArray);
    }
    public function hideQuestionsFeed()
    {
        if (!empty($_POST['user_id']) && !empty($_POST['question_id'])) {

        }
    }
    public function actionAnswerQuestion()
    {
        $model_answer = new Answers();
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $model_answer->question_id = $postData['question_id'];
            $model_answer->answer_text = $postData['answer'];
            $model_answer->mp_id = Yii::$app->user->id;

            if ($model_answer->save(false)) {
                //p($mp_user['email']);
                $mp_name = Common::get_user_name($model_answer->mp_id);
                $question_model = Questions::find()->where(["id" => $postData['question_id']])->one();
                $question = $question_model->question;
                $user_agent_name = $question_model->userAgent->name;
                $user_agent_email = $question_model->userAgent->email;
                $user_email = $model_answer->mp->email;
                $answer = $model_answer->answer_text;
                $emailformatemodel = EmailFormat::findOne(["title" => 'answer_question', "status" => '1']);
                if ($emailformatemodel) {

                    //create template file
                    $AreplaceString = array('{user_agent_name}' => $user_agent_name, '{question}' => $question, '{mp_name}' => $mp_name, '{answer}' => $answer);
                    $body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);

                    //send email for new generated password
                    Common::sendMailToUser($user_agent_email, $user_email, $emailformatemodel->subject, $body);
                }
                $question_louder_by = $question_model->louder_by;
                if (!empty($question_louder_by)) {
                    $louder_by_arr = explode(",", $question_louder_by);
                    foreach ($louder_by_arr as $key => $user_louder) {
                        $user_louder_detail = Common::get_name_by_id($user_louder, "Users");
                        $user_name = $user_louder_detail['name'];
                        $user_louder_email = $user_louder_detail['email'];
                        $emailformatemodel2 = EmailFormat::findOne(["title" => 'my_louder_answer', "status" => '1']);
                        if ($emailformatemodel2) {

                            //create template file
                            $AreplaceString2 = array('{user_name}' => $user_name, '{question}' => $question, '{mp_name}' => $mp_name, '{answer}' => $answer);
                            $body = Common::MailTemplate($AreplaceString2, $emailformatemodel2->body);

                            //send email for new generated password
                            Common::sendMailToUser($user_louder_email, $user_email, $emailformatemodel2->subject, $body);
                        }
                        # code...
                    }
                }
                //p($question_model->comments);
            }
            $answer_user = Common::get_name_by_id(Yii::$app->user->id, "Users");
            $ask_user = Questions::findOne($postData['question_id']);
            $userName = Common::get_user_name(Yii::$app->user->id);
            $query = Questions::find()->select(["questions.*", "questions.id"])->with('answers')->where(['questions.id' => $postData['question_id']]);
            $query = $query->joinWith(['answers' => function ($query) {
                return $query->andWhere("answers.id is not null");
            }]);
            //$query->groupBy(['answers.question_id']);
            $question = $query->all();
            $answered_mp = !empty($question[0]['answers']) ? array_column($question[0]['answers'], 'mp_id') : [];
            $pageDataAjax = $this->renderPartial('answersList', array(
                'answer_user' => $answer_user,
                'user_name' => $userName,
                'answer' => $postData['answer'],
            ));
            $pageDataAjax1 = $this->renderPartial('answered_by', array(
                'answered_mp' => $answered_mp,
                'question' => $question,
            ));
        } else {
            $pageDataAjax = "Bad request";
            $pageDataAjax1 = "";
        }
        $retArray = array('data' => $pageDataAjax, 'data2' => $pageDataAjax1, 'user_name' => $userName, 'ask_user_id' => $ask_user->user_agent_id);
        $model_notification = new Notifications();
        $model_notification->user_id = $ask_user->user_agent_id;
        $model_notification->notification = $userName . " answered your question ";
        $model_notification->save(false);

        return json_encode($retArray);
    }

    public function actionSaveComment()
    {
        $model_comment = new Comments();
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $model_comment->question_id = $postData['question_id'];
            $model_comment->comment_text = $postData['comment'];
            $model_comment->user_agent_id = Yii::$app->user->id;
            if ($model_comment->save(false)) {
                //p($mp_user['email']);
                $user_name = Common::get_user_name($model_comment->user_agent_id);
                $question_model = Questions::find()->where(["id" => $postData['question_id']])->one();
                $question = $question_model->question;
                $user_agent_name = $question_model->userAgent->name;
                $user_agent_email = $question_model->userAgent->email;
                $user_email = $model_comment->userAgent->email;
                $comment = $model_comment->comment_text;
                $emailformatemodel = EmailFormat::findOne(["title" => 'comment_question', "status" => '1']);
                if ($emailformatemodel) {

                    //create template file
                    $AreplaceString = array('{user_agent_name}' => $user_agent_name, '{question}' => $question, '{user_name}' => $user_name, '{comment}' => $comment);
                    $body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);

                    //send email for new generated password
                    Common::sendMailToUser($user_agent_email, $user_email, $emailformatemodel->subject, $body);
                }
            }

            $comment_user = Common::get_name_by_id(Yii::$app->user->id, "Users");
            $ask_user = Questions::findOne($postData['question_id']);

            $userName = Common::get_user_name(Yii::$app->user->id);

            $pageDataAjax = $this->renderPartial('commentList', array(
                'comment_user' => $comment_user,
                'user_name' => $userName,
                'comment' => $postData['comment'],
            ));
        } else {
            $pageDataAjax = "Bad request";
        }
        $retArray = array('data' => $pageDataAjax, 'comment' => $postData['comment'], 'user_name' => $userName, 'ask_user_id' => $ask_user->user_agent_id, "comment_user_id" => Yii::$app->user->id);
        if (Yii::$app->user->id != $ask_user->user_agent_id) {
            $model_notification = new Notifications();
            $model_notification->user_id = $ask_user->user_agent_id;
            $model_notification->notification = $userName . " commented your question ";
            $model_notification->save(false);
        }

        return json_encode($retArray);
    }
    public function actionReportQuestion()
    {
        $model_report = new QuestionReported();
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $model = QuestionReported::find()->where(['question_id' => $postData['question_id'], "user_id" => Yii::$app->user->id])->one();
            if (empty($model)) {
                $model_report->question_id = $postData['question_id'];
                $model_report->report_comment = $postData['report_comment'];
                $model_report->user_id = Yii::$app->user->id;
                $model_report->save(false);
                return json_encode("success");
            } else {
                return json_encode("reported");
            }
        } else {
            return json_encode("Bad request");
        }
    }
    public function actionRetractQuestion()
    {
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $question = Questions::find()->with('answers')->where(['id' => $postData['question_id']])->one();
            if (!empty($question['answers'])) {
                return json_encode("error");
            } else {
                $question->is_delete = 1;
                $question->save(false);
                return json_encode("success");
            }
            $model_report->question_id = $postData['question_id'];
            $model_report->report_comment = $postData['report_comment'];
            $model_report->user_id = Yii::$app->user->id;
            $model_report->save(false);
            return json_encode("success");
        } else {
            return json_encode("Bad request");
        }
    }

    public function actionHideQuestion()
    {
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $modelHide = QuestionHide::find()->where(['user_id' => Yii::$app->user->id])->one();
            if (!empty($modelHide)) {
                $modelHideQuestion = $modelHide;
                $modelHideQuestion->question_id = $modelHideQuestion->question_id . "," . $postData['question_id'];
            } else {
                $modelHideQuestion = new QuestionHide();
                $modelHideQuestion->question_id = $postData['question_id'];
                $modelHideQuestion->user_id = Yii::$app->user->id;

            }
            $modelHideQuestion->save(false);
            return json_encode("success");
        } else {
            return json_encode("Bad request");
        }
    }
    public function actionGetCitizenList()
    {
        if (!empty($_POST['page'])) {
            $requestData = Yii::$app->request->post();
            $dir = (!empty($requestData['sortdir']) && $requestData['sortdir'] == 'asc') ? SORT_ASC : SORT_DESC;
            $orderBy = ['name' => SORT_ASC];

            if (!empty($requestData['sortby'])) {
                if ($requestData['sortby'] == 'age') {
                    $orderBy = ["users.age" => $dir];
                } else if ($requestData['sortby'] == 'sex') {
                    $orderBy = ["users.gender" => $dir];
                } else if ($requestData['sortby'] == 'city') {
                    $orderBy = ["users.city" => $dir];
                }
            }
            $page = ($requestData['page'] - 1) * 12;
            // $page = 4;
            if (empty($requestData['sortby']) && empty($requestData['search'])) {
                $orderBy = ['answer_count' => SORT_DESC, 'comment_count' => SORT_DESC, 'share_count' => SORT_DESC];
                $query = Users::find()
                    ->joinWith(['answers', 'comments', 'shares'])
                    ->select(['users.*', 'COUNT(answers.id) AS answer_count', 'COUNT(comments.id) AS comment_count', 'COUNT(shares.id) AS share_count'])
                    ->where(['users.role_id' => Yii::$app->params['userroles']['user_agent'], "users.status" => Yii::$app->params['user_status_value']['active']])->asArray()->groupBy(['users.id'])->orderBy($orderBy);
            } else {
                $query = Users::find()
                    ->select(['users.*'])
                    ->where(['users.role_id' => Yii::$app->params['userroles']['user_agent'], "users.status" => Yii::$app->params['user_status_value']['active']]);

            }
            if (!empty($requestData['search'])) {
                $query = $query->where("users.name LIKE '%" . $requestData['search'] . "%'");
            }
            $query = $query->orderBy($orderBy);
            //  p($query);
            $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
            $totalCount = $pagination->totalCount;
            $pageSize = $pagination->pageSize;
            $total_pages = ceil($totalCount / $pageSize);
            //p($pagination);

            $models = $query->offset($page)
                ->limit(12)
                ->all();
            $pageDataAjax = $this->renderPartial('citizens', [
                'models' => $models, 'pagination' => $pagination,
                'total_pages' => $total_pages]);
            $retArray = array('data' => $pageDataAjax);
            return json_encode($retArray);
        }
    }
    public function actionEditProfile()
    {
        if (!empty($_POST)) {
            $education = $_POST['education'];
            $work = $_POST['work'];
            $user_id = $_POST['user_id'];
            $model = Users::findOne([$user_id]);
            if (!empty($model)) {
                $model->work = $work;
                $model->education = $education;
                $model->save(false);
                $retData = array("msg" => "success");

            } else {
                $retData = array("msg" => "error");
            }
            return json_encode($retData);
        }
    }
    public function actionViewQuestion($id)
    {
        $this->layout = "view_question";
        $model = Questions::find()
            ->with(['userAgent', 'answers' => function ($q) {
                return $q->orderBy(["answers.id" => SORT_DESC]);
            }, 'comments' => function ($q) {
                return $q->orderBy(["comments.id" => SORT_DESC]);
            }])->where(['id' => $id])->one();
        return $this->render('viewQuestion', [
            'model' => $model,
        ]);
    }
    public function actionClearNotifications()
    {
        if (!empty($_POST)) {
            $notifications = Notifications::find()->where(['user_id' => $_POST['user_id']])->all();
            foreach ($notifications as $key => $notification) {
                $notification->mark_read = 1;
                $notification->save(false);
            }
            $retData = array("msg" => "success");

        } else {
            $retData = array("msg" => "error");
        }
        return json_encode($retData);
    }
    public function actionFacebookShare()
    {
        if (!empty($_POST)) {
            $question = Shares::find()->where(['question_id' => $_POST['question_id'], 'user_agent_id' => Yii::$app->user->id])->one();
            if (empty($question)) {
                $model = new Shares();
                $model->question_id = $_POST['question_id'];
                $model->user_agent_id = Yii::$app->user->id;
                $model->save(false);
                $retData = array("msg" => "success");
            } else {
                $retData = array("msg" => "error");
            }
        } else {
            $retData = array("msg" => "error_fail");
        }
        return json_encode($retData);
    }

    public function actionCheckIfShared()
    {
        if (!empty($_POST)) {
            $question = Shares::find()->where(['question_id' => $_POST['question_id'], 'user_agent_id' => Yii::$app->user->id])->one();
            if (empty($question)) {
                $retData = array("msg" => "success");
            } else {
                $retData = array("msg" => "error");
            }
        }
        return json_encode($retData);
    }

    public function actionSaveQuestion()
    {
        $model = new Questions();
        if (!empty(Yii::$app->request->post())) {
            $postData = Yii::$app->request->post();
            $monday = Common::getLastMondaySaturday("monday");
            $saturday = Common::getLastMondaySaturday("saturday");
            $query = Questions::find()->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0]);
            $query->andWhere(['between', 'created_at', $monday, $saturday]);
            $questionCount = $query->count();
            if ($questionCount == 10) {
                return json_encode("error");
            } else {
                $model->user_agent_id = Yii::$app->user->id;
                $model->mp_id = implode(",", $postData['mp_id']);
                $model->question = $postData['question'];
                if ($model->save()) {
                    $user_agent_name = $model->userAgent->name;
                    foreach ($postData['mp_id'] as $key => $mp) {
                        $mp_user = Common::get_name_by_id($mp, "Users");
                        if (!empty($mp_user)) {
                            //p($mp_user['email']);
                            $mp_email = $mp_user['email'];
                            $mp_username = $mp_user['name'];
                            $question = $model->question;
                            $user_agent_email = $model->userAgent->email;
                            $emailformatemodel = EmailFormat::findOne(["title" => 'ask_question', "status" => '1']);
                            if ($emailformatemodel) {

                                //create template file
                                $AreplaceString = array('{mp_username}' => $mp_username, '{question}' => $question, '{user_agent_name}' => $user_agent_name);
                                $body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);

                                //send email for new generated password
                                Common::sendMailToUser($mp_email, $user_agent_email, $emailformatemodel->subject, $body);
                            }
                        }
                        $model_notification = new Notifications();
                        $model_notification->user_id = $mp;
                        $model_notification->notification = $user_agent_name . " has asked you a question ";
                        $model_notification->save(false);
                    }
                    $data = ["user_agent_name" => $user_agent_name];
                    return json_encode($data);
                };
            }
            //return ActiveForm::validate($model);
        }
    }

    public function actionChangePassword()
    {
        $this->layout = "forgot_password";
        $model = new ChangePasswordForm();

        //ajax validation code start
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }
        // set data into model and validate model
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Get user details
            $usermodel = Users::findOne(Yii::$app->user->id);
            //set password
            $usermodel->password = md5($model->newPassword);
            //save password
            $usermodel->save(false);

            return $this->goHome();
        } else {
            return $this->render('change_password', compact('model'));
        }
    }
    public function actionUpdateProfilePic()
    {
        $model = Users::findOne(Yii::$app->user->id);
        if ($model) {
            $old_image = $model->photo;
            if (!empty($_FILES)) {
                //  p($_FILES['file']['name']);
                $file = pathinfo($_FILES['file']['name']);
                $file_name = $file['filename'] . "_" . uniqid() . "." . $file['extension'];
                $file_filter = str_replace(" ", "", $file_name);
                if (!empty($old_image) && file_exists(Yii::getAlias('@root') . '/frontend/web/uploads/' . $old_image)) {
                    unlink(Yii::getAlias('@root') . '/frontend/web/uploads/' . $old_image);
                }
                // $file->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/' . $file_filter, false);
                move_uploaded_file($_FILES['file']['tmp_name'], Yii::getAlias('@root') . '/frontend/web/uploads/' . $file_filter);
                $model->photo = $file_filter;
            } else {
                $model->photo = $old_image;
            }
            if ($model->save(false)) {
                $data = "success";
                return json_encode($data);
            } else {
                $data = "error";
                return json_encode($data);
            }
        } else {
            $data = "error";
            return json_encode($data);
        }
    }

}
