<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\RepresentativesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="representatives-search">

    <?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
    'options' => [
        'data-pjax' => 1,
    ],
]);?>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'user_name')?>
</div>
</div>
<div class="row">
    <div class="span3 style_input_width">
    <?=$form->field($model, 'standing_commitee')?>
</div>
</div>

   <div class="form-group">
        <?=Html::submitButton('Search', ['class' => 'btn btn-primary'])?>
        <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> clear'), Yii::$app->urlManager->createUrl(['representatives/index', "temp" => "clear"]), ['class' => 'btn btn-default'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
