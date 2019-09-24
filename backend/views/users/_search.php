<?php

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
<div class="row">
        <div class="span3 style_input_width">
    <?=$form->field($model, 'role_id')?></div>
<div class="span3 style_input_width">
    <?=$form->field($model, 'email')?></div>
</div>

    <?=$form->field($model, 'password')?>

    <?=$form->field($model, 'user_name')?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'age') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'years_hopr') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'badge_count') ?>

    <?php // echo $form->field($model, 'standing_commitee') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
