<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Representatives */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="email-format-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
    </div>
    <div class="block-content collapse in">
<div class="representatives-form span12 common_search">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?=$form->field($model, 'user_name')->textInput(['maxlength' => true])?>

    <?=$form->field($model, 'standing_commitee')->textInput(['maxlength' => true])?>

   <?=$form->field($model, 'photo')->fileInput(['id' => 'photo', 'value' => $model->photo]);?>
   <img id="image" width="100px" hieght="100px" src="<?php echo Yii::getAlias('@web') . "/../frontend/web/uploads/" . $model->photo; ?>" alt="" />

    <div class="form-group">
        <?=Html::submitButton('Save', ['class' => 'btn btn-success'])?>
    </div>

    <?php ActiveForm::end();?>

</div>
</div>
</div>
<script type="text/javascript">

     $( document ).ready(function(){
        $("#photo").change(function() {
        readURL(this);
        });
          });

    function readURL(input) {

  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#image').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

</script>