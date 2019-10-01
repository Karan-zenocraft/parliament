<?php
use common\components\Common;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $this yii\web\View */
/* @var $model common\models\Questions */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Parliament';
?>
<div class="site-index">

<div class="questions-form">

    <?php
if (Common::get_user_role(Yii::$app->user->id, "0") == "3") {

    $form = ActiveForm::begin();?>

    <?=$form->field($model, 'question')->textArea(['maxlength' => true, "onkeyup" => "countChar(this)"])?>

    <div id="charNum" style="float: right;">0/540</div>
    <div class="form-group">
        <?=Html::submitButton('ASK', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();
}
?>

</div>
    <div class="body-content">

        <div class="row">
            <div class="col-lg-12">
                <h2>Heading</h2>

                <p><?php
if (!empty($questions)) {
    foreach ($questions as $key => $question) {
        echo "<p><strong>" . $question['userAgent']['user_name'] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbspUnanswered for " . $question['mp']['user_name'] . "</strong></p>";
        echo "<p>" . Common::time_elapsed_string($question['created_at']) . "</p>";
        echo "<p>" . $question['question'] . "</p>";
        echo "<p><a href='javascript::void(0);'>Make it Louder</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='javascript:coid(0);'>Comment</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp<a href='javascript:coid(0);'>Share</a></p>";
    }
}
?></p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
<script>
      function countChar(val) {
         $('#charNum').text(len+"/540");
        var len = val.value.length;
        if (len >= 540) {
        val.value = val.value.substring(0, 540);
          $('#charNum').text("540/540");
          $('#charNum').css('color', 'red');
        } else {
          $('#charNum').css('color', 'black');
          $('#charNum').text(len+"/540");
        }
      };
    </script>
