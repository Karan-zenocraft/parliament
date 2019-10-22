<?php
namespace frontend\controllers;

use common\components\Common;
use common\models\Answers;
use common\models\Comments;
use common\models\LoginForm;
use common\models\QuestionHide;
use common\models\QuestionReported;
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
        $mpArr = ArrayHelper::map(Users::find()->where(['role_id' => Yii::$app->params['userroles']['MP']])->orderBy('user_name')->asArray()->all(), 'id', 'user_name');
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
        $totalCount = $pagination->totalCount;
        $pageSize = $pagination->pageSize;
        $total_pages = ceil($totalCount / $pageSize);
        //p($pagination);

        $models = $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->all();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $postData = Yii::$app->request->post();
            $model->user_agent_id = Yii::$app->user->id;
            $model->mp_id = implode(",", $postData['Questions']['mp_id']);
            $model->save();
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

        }

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
            'errors' => $errors,
            'total_pages' => $total_pages,
            'modelsQuestions' => $modelsQuestions,
            'paginationQuestion' => $paginationQuestion,
            'total_pages_questions' => $total_pages_questions,
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
                    $query = $query->where("users.user_name LIKE '%" . $requestData['search'] . "%'");
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
                    $retData .= "<img src=" . $user_image . " class='img-fluid SliderImage'></div><a href='#'><div class='RowTitle'><p>" . $value['user_name'] . "</p><p><span>" . $value['standing_commitee'] . "<br>Standing Committee</span></p></div></a></div>";
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
    public function actionMakeLouder()
    {
        $question_id = $_POST['question_id'];
        if (!empty($_POST['event'])) {
            $question = Questions::find()->where(['id' => $question_id, 'status' => Yii::$app->params['user_status_value']['active']])->one();
            //  $data = array();
            if ($_POST['event'] == "like") {
                $question->louder_by = (empty($question->louder_by) || ($question->louder_by == "")) ? Yii::$app->user->id : $question->louder_by . "," . Yii::$app->user->id;
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
            $data = ["event" => $event, "louderCount" => $louderCount, "louder_by" => Common::get_user_name(Yii::$app->user->id), "ask_user_id" => $question->user_agent_id];
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
                $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                    return $query->andWhere("answers.id is null");
                }]);
            } elseif ($flagCond == 'Answered') {
                // GET LOGIN USER'S ANSWERED QUESTIONS
                if ($user_role_id == Yii::$app->params['userroles']['user_agent']) {
                    $questionsQuery = $questionsQuery->andwhere(['user_agent_id' => $loginId]);
                    $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                        return $query->andWhere("answers.id is not null");
                    }]);
                } else {
                    $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) use ($loginId) {
                        return $query->andWhere(["answers.mp_id" => $loginId]);
                    }]);
                    $questionsQuery->groupBy(['answers.question_id']);
                }

            } elseif ($flagCond == 'Unanswered') {
                // GET LOGIN USER'S UNANSWERED QUESTIONS
                if ($user_role_id == Yii::$app->params['userroles']['user_agent']) {
                    $questionsQuery = $questionsQuery->andwhere(['user_agent_id' => $loginId]);
                    $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                        return $query->andWhere("answers.id is null");
                    }]);
                } else {
                    $questionsQuery = $questionsQuery->andwhere(new \yii\db\Expression('FIND_IN_SET(' . $loginId . ',questions.mp_id)'));
                    $questionsQuery = $questionsQuery->joinWith(['answers' => function ($query) {
                        return $query->andWhere("answers.id is null");
                    }]);
                }

            } elseif (($flagCond = 'Homefeed')) {
                $questionsQuery;
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

                $questionsQuery = $questionsQuery->select(["*", "(LENGTH(louder_by) - LENGTH(REPLACE(louder_by, ',','')) + 1) AS louder_count"]);
                $questionsQuery = $questionsQuery->orderBy(["louder_count" => SORT_DESC]);
            } else {
                $questionsQuery->orderBy(["questions.id" => SORT_DESC]);
            }

            $models = $questionsQuery
                ->offset($page)
                ->limit(5)
                ->all();
            if (!empty($models)) {
                $pageDataAjax = $this->renderPartial('questions', array(
                    'modelsQuestions' => $models,
                ));
            } else {
                $pageDataAjax = "No more records found.";
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
            $model_answer->save(false);

            $answer_user = Common::get_name_by_id(Yii::$app->user->id, "Users");
            $userName = Common::get_user_name(Yii::$app->user->id);

            $pageDataAjax = $this->renderPartial('answersList', array(
                'answer_user' => $answer_user,
                'user_name' => $userName,
                'answer' => $postData['answer'],
            ));
        } else {
            $pageDataAjax = "Bad request";
        }
        $retArray = array('data' => $pageDataAjax);
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
            $model_comment->save(false);

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
        $retArray = array('data' => $pageDataAjax, 'comment' => $postData['comment'], 'user_name' => $userName, 'ask_user_id' => $ask_user->user_agent_id);
        return json_encode($retArray);
    }
    public function actionReportQuestion()
    {
        $model_report = new QuestionReported();
        if (Yii::$app->request->post()) {
            $postData = Yii::$app->request->post();
            $model_report->question_id = $postData['question_id'];
            $model_report->report_comment = $postData['report_comment'];
            $model_report->user_id = Yii::$app->user->id;
            $model_report->save(false);
            return json_encode("success");
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
            $page = ($requestData['page'] - 1) * 4;
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
                $query = $query->where("users.user_name LIKE '%" . $requestData['search'] . "%'");
            }
            $query = $query->orderBy($orderBy);
            //  p($query);
            $pagination = new Pagination(['totalCount' => $query->count(), 'pageSize' => 4]);
            $totalCount = $pagination->totalCount;
            $pageSize = $pagination->pageSize;
            $total_pages = ceil($totalCount / $pageSize);
            //p($pagination);

            $models = $query->offset($page)
                ->limit(4)
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
        $this->layout = "question_detail";
        $model = Questions::findOne($id);
        return $this->render('viewQuestion', [
            'model' => $model,
        ]);
    }

}
