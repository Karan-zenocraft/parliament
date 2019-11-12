<?php

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div class="pages-form">

    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span12">
            <?php $form = ActiveForm::begin();?>
            <?php // $form->field($model, 'custom_url')->textInput(['maxlength' => 255,'autofocus'=>'autofocus']) ?>
            <?=$form->field($model, 'page_title')->textInput(['maxlength' => 255])?>
            <?=$form->field($model, 'page_content')->widget(CKEditor::className(), ['preset' => 'basic'])?>
            <?=$form->field($model, 'custom_url')->textInput(['maxlength' => 255])?>
            <?php // $form->field($model, 'page_content')->textarea(['rows' => 6]) ?>
            <?=$form->field($model, 'meta_title')->textInput(['maxlength' => 255])?>
            <?=$form->field($model, 'meta_keyword')->textInput(['maxlength' => 255])?>
            <?=$form->field($model, 'meta_description')->textarea(['rows' => 6])?>
            <?php // $form->field($model, 'status')->dropDownList(Yii::$app->params['status']) ?>


            <div class="form-actions">
                <?=Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary'])?>
                <?=Html::a(Yii::t('app', 'Cancel'), Yii::$app->urlManager->createUrl(['pages/index']), ['class' => 'btn default'])?>
            </div>

            <?php ActiveForm::end();?>
        </div>
    </div>

</div>
