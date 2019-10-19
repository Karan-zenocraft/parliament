<?php

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
    <?=$form->field($model, 'mp_id')?>
</div>
</div>
    <?php //$form->field($model, 'louder_by')?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
