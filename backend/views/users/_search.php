<?php

use common\models\UserRoles;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\UsersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <?php //$form->field($model, 'id') ?>
     <?php
$UserRolesDropdown = ArrayHelper::map(array("" => "") + UserRoles::find()->where("id !=" . Yii::$app->params['userroles']['admin'])->asArray()->all(), 'id', 'role_name');
//$form->field($model, 'last_name')
?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'role_id')->dropDownList($UserRolesDropdown);?></div>
    <div class="span3 style_input_width">
    <?=$form->field($model, 'email')?></div>
    <div class="span3 style_input_width">
    <?=$form->field($model, 'user_name')?></div>
    <div class="span3 style_input_width">
    <?php echo $form->field($model, 'city') ?></div>
</div>


<div class="row">
       <div class="span3 style_input_width">
 <?php echo $form->field($model, 'age') ?></div>

       <div class="span3 style_input_width">
 <?php echo $form->field($model, 'gender')->dropDownList(array("" => "") + Yii::$app->params['gender']); ?></div>

       <div class="span3 style_input_width">
 <?php echo $form->field($model, 'education') ?></div>

       <div class="span3 style_input_width">
 <?php echo $form->field($model, 'status')->dropDownList(Yii::$app->params['user_status']); ?></div>

</div>
<div class="row">

       <div class="span3 style_input_width">
    <?php echo $form->field($model, 'years_hopr') ?></div>

       <div class="span3 style_input_width">
    <?php echo $form->field($model, 'standing_commitee') ?></div>
</div>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'badge_count') ?>



    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

   <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['users/index', "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
