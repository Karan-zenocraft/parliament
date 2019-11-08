<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 col-lg-8 col-xl-5 LoginLeft">
                    <div class="Form">
                         <?php $form = ActiveForm::begin(['id' => 'login-form']);?>
                        <table>
                            <tr>
                                <td>
                                    <label for="Email or Username">Email or Username</label>
                                </td>
                                <td class="Password-md">
                                    <label for="Password">Password</label>
                                </td>
                            </tr>
                            <tr>
                                <td>  <?=$form->field($model, 'email')->textInput(['autofocus' => true])->label(false);?></td>
                                <td class="Password-sm">
                                    <label for="Password">Password</label>
                                </td>
                                <td><?=$form->field($model, 'password')->passwordInput()->label(false);?></td>
                            </tr>
                            <tr>
                                <td><a href="<?php echo Yii::$app->urlManager->createUrl(['site/request-password-reset']); ?>" class="ForgotButton">Forgotten Password?</a></td>

                                <td><div class="form-group">
                    <?=Html::submitButton('Login', ['class' => 'btn btn-primary LoginButton', 'name' => 'login-button'])?>
                </div></td>
                            </tr>
                        </table>
                        <?php ActiveForm::end();?>
                    </div>
                </div>
                <div class="col-md-12 col-xl-7 LoginRight">
                    <h1>Not a member? <br>
                        Send us a request at <br>
                        register@B4P.et</h1>

                </div>
            </div>
            <div class="row">
                <div class="LoginBottom col-md-12">
                    <ul class="d-flex align-items-center justify-content-start flex-wrap">
                        <li><a href="#">About Bridge</a></li>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Announcements</a></li>
                    </ul>

                </div>
            </div>

        </div>
