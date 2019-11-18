<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<style>
    .ForgotRight input{padding-left: 5px;}
    .ForgotRight input::placeholder{font-size: 11px;}


    @media (max-width: 1199px) and (min-width: 320px){
        
        header .ForgotRight form .form-group{text-align: center;}
/*        header .ForgotRight form .form-group .help-block{text-align: left!important;}*/
    }

</style>

<div class="col-md-12 col-xl-7 HeaderRight ForgotRight">
     <h1>Change Password</h1>

     <?php $form = ActiveForm::begin(['enableAjaxValidation' => true, 'enableClientValidation' => 'true', 'options' => ['class' => 'form-horizontal']]);?>
                        <?=$form->field($model, 'currentPassword')->passwordInput(['maxlength' => 255, 'placeholder' => 'Enter Current Password', 'class' => 'span6 m-wrap'])?>
                        <?=$form->field($model, 'newPassword')->passwordInput(['maxlength' => 255, 'placeholder' => 'Enter New Password', 'class' => 'span6 m-wrap'])?>
                        <?=$form->field($model, 'retypePassword')->passwordInput(['rows' => 6, 'placeholder' => 'Enter Retype New Password', 'class' => 'span6 m-wrap'])?>
                        <?php /* $form->field($model, 'status', ['template' => '<div class="control-group">{label}<div class="controls">{input}</div></div>'])->textInput() ?>
<?= $form->field($model, 'created_at')->textInput() ?>
<?= $form->field($model, 'updated_at')->textInput() */?>
                        <div class="form-group">
                            <?=Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary Btn'])?>
                        </div>
                   <!-- END FORM-->
                   <?php ActiveForm::end();?>
</div>

