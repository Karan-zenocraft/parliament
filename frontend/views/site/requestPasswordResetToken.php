<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="col-md-12 col-xl-7 HeaderRight ForgotRight">
                    <h1>Request password reset</h1>

                    <p>Please fill out your email. A link to reset password will be sent there.</p>
  <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form col-md-8 col-lg-6']);?>

                <?=$form->field($model, 'email')->textInput(['autofocus' => true, "placeholder" => "Enter email"])?>

                <div class="form-group">
                    <?=Html::submitButton('Send', ['class' => 'btn btn-primary Btn'])?>
                </div>

            <?php ActiveForm::end();?>
                </div>
