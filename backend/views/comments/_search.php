<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\CommentsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comments-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index', 'qid' => $_GET['qid']],
    'method' => 'get',
]);?>

    <?php //$form->field($model, 'id')?>

    <?php //$form->field($model, 'question_id')?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'comment_text')?>
    </div>
<div class="span3 style_input_width">
    <?=$form->field($model, 'user_agent_id')?>
</div>
</div>

    <?php //$form->field($model, 'status')?>

    <?php // echo $form->field($model, 'is_delete') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

      <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['comments/index', 'qid' => $_GET['qid'], "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
