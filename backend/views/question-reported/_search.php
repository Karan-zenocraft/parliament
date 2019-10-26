<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionReportedSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-reported-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <?php // $form->field($model, 'id') ?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'question_id')?>
</div>
    <div class="span3 style_input_width">
    <?=$form->field($model, 'user_id')?>
</div>
</div>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'report_comment')?>
</div></div>
    <?php //$form->field($model, 'created_at')?>

    <?php // echo $form->field($model, 'updated_at') ?>

     <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['question-reported/index', "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
