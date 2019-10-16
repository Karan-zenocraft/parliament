<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>
<div class="col-md-12 col-xl-7 HeaderRight ForgotRight">
     <h1>Reset Password</h1>

                    <p>Please reset password here</p>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form col-md-8 col-lg-6']);?>

                <?=$form->field($model, 'password')->passwordInput(['autofocus' => true, "class" => "form-control", "placeholder" => "Enter password"])?>

                <div class="form-group">
                    <?=Html::submitButton('Submit', ['class' => 'btn btn-primary Btn'])?>
                </div>

            <?php ActiveForm::end();?>
</div>

