<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="email-format-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
    </div>
    <div class="block-content collapse in">
<div class="users-form span12 common_search">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

     <div class="row">
        <div class="span3 style_input_width"><?=$form->field($model, 'role_id')->dropDownList($UserRolesDropdown, ['class' => 'roles'])?></div>

    <div class="span3 style_input_width"><?=$form->field($model, 'user_name')->textInput(['maxlength' => true])?></div>

    <div class="span3 style_input_width"><?=$form->field($model, 'email')->textInput(['maxlength' => true])?></div>
 <div class="span3 style_input_width"><?=$form->field($model, 'name')->textInput(['maxlength' => true])?></div>
</div>
<div class="row">
    <?php if ($model->isNewRecord) {?>
    <div class="span3 style_input_width"><?=$form->field($model, 'password')->passwordInput(['maxlength' => true])?></div>
<?php }?>
        <div class="span3 style_input_width">
    <?=$form->field($model, 'city')->textInput()?></div>
<div class="span3 style_input_width">
    <?=$form->field($model, 'age')->textInput()?></div>
<div class="span3 style_input_width">
    <?=$form->field($model, 'education')->textInput()?></div>
</div>
<div class="row">
     <div class="span3 style_input_width">
    <?=$form->field($model, 'status')->dropDownList(Yii::$app->params['user_status']);?></div>
        <div class="span3 style_input_width">
            <?=$form->field($model, 'photo')->fileInput(['id' => 'photo', 'value' => $model->photo]);?>
            </div>
            <div class="span3 style_input_width">
            <?=$form->field($model, 'gender')->radioList(Yii::$app->params['gender']);?>
        </div>
        <div class="span3 style_input_width">
    <?=$form->field($model, 'work')->textInput()?></div>
        </div>
        <div class="row">
<div class="span3">
    <img id="image" width="100px" hieght="100px" src="<?php echo Yii::getAlias('@web') . "/../frontend/web/uploads/" . $model->photo; ?>" alt="" />
    </div>
</div>
<div class="row pickup_row">

    <div class="span3 style_input_width"><?=$form->field($model, 'years_hopr')->textInput()?></div>

    <div class="span3 style_input_width"><?=$form->field($model, 'standing_commitee')->textInput(['maxlength' => true])?></div>
</div>

        <div class="form-group form-actions">
                <?=Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])?>
                <?=Html::a(Yii::t('app', 'Cancel'), Yii::$app->urlManager->createUrl(['users/index']), ['class' => 'btn default'])?>
            </div>

    <?php ActiveForm::end();?>

</div>
<script type="text/javascript">

     $( document ).ready(function(){
        $("#photo").change(function() {
        readURL(this);
        });
        if($("#users-role_id").val() =="<?php echo Yii::$app->params['userroles']['MP']; ?>"){
             $(".pickup_row").show();
        }else{
            $(".pickup_row").hide();
        }
        $("#users-role_id").change(function(){
        var role = $(this).val();
        if(role == "<?php echo Yii::$app->params['userroles']['MP']; ?>"){
            $(".pickup_row").show();
        }else{
            $(".pickup_row").hide();
        }
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