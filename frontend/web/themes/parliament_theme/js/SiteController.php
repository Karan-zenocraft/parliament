<?php
namespace backend\controllers;

use backend\components\AdminCoreController;
use common\components\Common;
use common\models\AdminLoginForm;
use common\models\ChangePasswordForm;
use common\models\EmailFormat;
use common\models\ForgotPasswordForm;
use common\models\LoginForm;
use common\models\Users;
use Yii;

//Load common models
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends AdminCoreController
{
    /**
     * {@inheritdoc}
     */
/*    public function behaviors()
{
return [
'access' => [
'class' => AccessControl::className(),
'rules' => [
[
'actions' => ['login', 'error'],
'allow' => true,
],
[
'actions' => ['logout', 'index'],
'allow' => true,
'roles' => ['@'],
],
],
],
'verbs' => [
'class' => VerbFilter::className(),
'actions' => [
'logout' => ['post'],
],
],
];
}*/

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin_old()
    {
        $this->layout = "login";
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    public function actionLogin()
    {
        $this->layout = "login";
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        $forgotPasswordModel = new ForgotPasswordForm();
        //set scenario for this model
        $forgotPasswordModel->scenario = 'forgot_password';

        //ajax validation code start
        if (Yii::$app->request->isAjax && $forgotPasswordModel->load(Yii::$app->request->post())) {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($forgotPasswordModel);
        }

        //compare login
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
        } elseif ($forgotPasswordModel->load(Yii::$app->request->post()) && $forgotPasswordModel->validate()) {

            //successfully validte after get user details.
            $usermodel = Users::findOne(['email' => $forgotPasswordModel->email]);
            if (!empty($usermodel)) {
                //generate rendome new password
                $password = Common::generatePassword();
                //new password convert to md5
                $Npwd = md5($password);
                $usermodel->password = $Npwd;
                //save password
                $usermodel->Save();

                //Get email template into database for forgot password
                $emailformatemodel = EmailFormat::findOne(["title" => 'forgot_password', "status" => '1']);
                if ($emailformatemodel) {

                    //create template file
                    $AreplaceString = array('{password}' => $password, '{username}' => $usermodel->user_name, '{email}' => $usermodel->email);
                    $body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);

                    //send email for new generated password
                    Common::sendMailToUser($forgotPasswordModel->email, Yii::$app->params['adminEmail'], $emailformatemodel->subject, $body);
                    Yii::$app->session->setFlash('success', Yii::getAlias('@admin_user_forget_password_msg'));
                }
                return $this->goBack();
                //return $this->redirect(Yii::$app->urlManager->createUrl(['site/index']));
            }
        } else {
            return $this->render('login', compact('model', 'forgotPasswordModel'));
        }
    }

    public function actionChangePassword()
    {
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

            Yii::$app->session->setFlash('success', Yii::getAlias('@admin_user_change_password_msg'));
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/change-password']));
        } else {
            return $this->render('change_password', compact('model'));
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
