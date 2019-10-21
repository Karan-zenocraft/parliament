<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AnswersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answers-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index', 'qid' => $_GET['qid']],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>

    <?php //$form->field($model, 'id')?>

    <?php //$form->field($model, 'question_id')?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'answer_text')?>
</div>
<div class="span3 style_input_width">
    <?=$form->field($model, 'mp_id')?>
</div>
</div>

    <?php //$form->field($model, 'created_at')?>

    <?php // echo $form->field($model, 'updated_at') ?>

     <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['answers/index', 'qid' => $_GET['qid'], "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
