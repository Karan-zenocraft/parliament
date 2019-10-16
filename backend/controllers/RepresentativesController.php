<?php

namespace backend\controllers;

use backend\components\AdminCoreController;
use common\models\Representatives;
use common\models\RepresentativesSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * RepresentativesController implements the CRUD actions for Representatives model.
 */
class RepresentativesController extends AdminCoreController
{
    /**
     * {@inheritdoc}
     */
    /* public function behaviors()
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
     * Lists all Representatives models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RepresentativesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Representatives model.
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
     * Creates a new Representatives model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Representatives();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $file = \yii\web\UploadedFile::getInstance($model, 'photo');
            if (!empty($file)) {
                $file_name = $file->basename . "_" . uniqid() . "." . $file->extension;
                $model->photo = $file_name;
                $file->saveAs(Yii::getAlias('@root') . '/frontend/web/uploads/' . $file_name);
            }
            $model->save(false);
            Yii::$app->session->setFlash('success', Yii::getAlias('@user_add_message'));

            return $this->redirect(['representatives/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Representatives model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_image = $model->photo;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
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

            return $this->redirect(['representatives/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Representatives model.
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
     * Finds the Representatives model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Representatives the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Representatives::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
