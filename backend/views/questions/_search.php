<?php

use common\models\Users;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="questions-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <?php //$form->field($model, 'id')?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'user_agent_id')?>
</div>
    <div class="span3 style_input_width">
    <?=$form->field($model, 'question')?>
</div>
</div>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'mp_id')->dropDownList(array("" => "") + ArrayHelper::map(Users::find()->where(['role_id' => Yii::$app->params['userroles']['MP']])->orderBy('user_name')->asArray()->all(), 'id', 'user_name'))?>
</div>
</div>
    <?php //$form->field($model, 'louder_by')?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

   <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['questions/index', "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
