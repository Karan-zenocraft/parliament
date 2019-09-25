<?php

namespace backend\controllers;

use backend\components\AdminCoreController;
use common\components\Common;
use common\models\EmailFormat;
use common\models\UserRoles;
use common\models\Users;
use common\models\UsersSearch;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * UsersController implements the CRUD actions for Users model.
 */
class UsersController extends AdminCoreController
{
    /**
     * {@inheritdoc}
     */
    /*  public function behaviors()
    {
    return [
    'verbs' => [
    'class' => VerbFilter::className(),
    'actions' => [
    'delete' => ['POST'],
    ],
    ],
    ];
    }*/

    /**
     * Lists all Users models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UsersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $UserRolesDropdown = ArrayHelper::map(UserRoles::find()->where("id !=" . Yii::$app->params['userroles']['admin'])->asArray()->all(), 'id', 'role_name');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'UserRolesDropdown' => $UserRolesDropdown,
        ]);
    }

    /**
     * Displays a single Users model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Users model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $backEndBaseUrl = Yii::$app->urlManager->createAbsoluteUrl(['/site/index']);
        $frontEndBaseUrl = Yii::$app->params['root_url'];
        $backendLoginURL = Yii::$app->params['site_url'] . Yii::$app->params['login_url'];
        $model = new Users();
        // $model->setScenario('create');
        $UserRolesDropdown = ArrayHelper::map(UserRoles::find()->where("id !=" . Yii::$app->params['userroles']['admin'])->asArray()->all(), 'id', 'role_name');
        //p(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->password = md5($_REQUEST['Users']['password']);
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $file_name = $file->basename . "_" . uniqid() . "." . $file->extension;
                $model->photo = $file_name;
                $file->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/' . $file_name);
            }
            $model->save(false);
            ///////////////////////////////////////////////////////////
            //Get email template into database for user registration
            $emailformatemodel = EmailFormat::findOne(["title" => 'user_registration', "status" => '1']);
            if ($emailformatemodel) {
                $url = "<strong>URL :</strong><a href=$frontEndBaseUrl>" . $frontEndBaseUrl . "</a>";

                //create template file
                $AreplaceString = array('{password}' => Yii::$app->request->post('Users')['password'], '{username}' => $model->user_name, '{email}' => $model->email, '{loginurl}' => $url);

                $body = Common::MailTemplate($AreplaceString, $emailformatemodel->body);
                //send email for new generated password
                Common::sendMailToUser($model->email, Yii::$app->params['adminEmail'], $emailformatemodel->subject, $body);

                //////////////////////////////////////////////////////////
                Yii::$app->session->setFlash('success', Yii::getAlias('@user_add_message'));
            }
            return $this->redirect(['users/index']);
        } else {
            return $this->render('create', [
                'model' => $model,
                'UserRolesDropdown' => $UserRolesDropdown,
            ]);
        }
    }

    /**
     * Updates an existing Users model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->photo;
        $UserRolesDropdown = ArrayHelper::map(UserRoles::find()->where("id !=" . Yii::$app->params['userroles']['admin'])->asArray()->all(), 'id', 'role_name');
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $postData = Yii::$app->request->post();
            $model->password = md5($postData['Users']['password']);

            if ($postData['Users']['role_id'] == Yii::$app->params['userroles']['MP']) {
                $model->years_hopr = "";
                $model->standing_commitee = "";
            } else {
                $model->years_hopr = $postData['Users']['years_hopr'];
                $model->standing_commitee = $postData['Users']['standing_commitee'];
            }
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $delete = $model->oldAttributes['photo'];
                $file_name = $file->basename . "_" . uniqid() . "." . $file->extension;

                $model->photo = $file_name;
                if (!empty($old_image) && file_exists(Yii::getAlias('@root') . '/frontend/web/uploads/' . $old_image)) {
                    unlink(Yii::getAlias('@root') . '/frontend/web/uploads/' . $old_image);
                }
                $file->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/' . $file_name, false);
                $model->photo = $file_name;
            } else {
                $model->photo = $old_image;
            }
            $model->save();
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_add_message'));

            return $this->redirect(['users/index']);
        }

        return $this->render('update', [
            'model' => $model,
            'UserRolesDropdown' => $UserRolesDropdown,

        ]);
    }

    /**
     * Deletes an existing Users model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Users model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
