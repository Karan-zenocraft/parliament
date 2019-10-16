<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$this->title = 'Reset password';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-reset-password">
    <h1><?=Html::encode($this->title)?></h1>

    <p>Please choose your new password:</p>

    <div class="row">
        <div class="col-lg-5">
                  <h1>Request password resets</h1>

                    <p>Please fill out your email. A link to reset password will be sent there.</p>


                    <form action="/action_page.php" class="col-md-8 col-lg-6">
                        <div class="form-group">

                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <button type="submit" class="Btn">Submit</button>

                    </form>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']);?>

                <?=$form->field($model, 'password')->passwordInput(['autofocus' => true, "class" => "form-control", "placeholder" => "Enter email"])?>

                <div class="form-group">
                    <?=Html::submitButton('Submit', ['class' => 'btn btn-primary Btn'])?>
                </div>

            <?php ActiveForm::end();?>
        </div>
    </div>
</div>


