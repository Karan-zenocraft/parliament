<?php
use common\components\Common;
use common\models\Users;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<nav class="Nav1 OnlySm">
  <ul class="d-flex align-items-center justify-content-between nav nav-tabs">
    <li class="BGList"><a href="#home" onclick="filterQuestion('Homefeed')" data-toggle="tab" class="active show">Home Feed</a></li>
    <li><a href="#menu1"  data-toggle="tab" onclick="filterQuestion('Unanswered')" class="show">Unanswered</a></li>
    <li><a href="#menu2"  data-toggle="tab"  onclick="filterQuestion('Answered')" class="show">Answered</a></li>
    <li><a href="#menu3"  data-toggle="tab"  id="citizen" onclick="AjaxCallSortCitizen()" class="show">Citizens</a></li>
  </ul>
</nav>
<a href="<?php echo Yii::getAlias('@web') ?>"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo"></a>
<div class="MainLeftInner EditProfileMain">
  <?php $user_id = !empty($_REQUEST['user_id']) ? $_REQUEST['user_id'] : Yii::$app->user->id;
$user = Common::get_name_by_id($user_id, "Users");
?>
  <div class="ProfileLeft">
    <?php if (!empty($_REQUEST) && !empty($_REQUEST['user_id']) && ($_REQUEST['user_id'] == Yii::$app->user->id)) {?>
    <div class="EditProfiles">
      <a href="#" data-toggle="modal" data-target="#editProfile" class="EditProfileBtn">EDIt</a>
    </div>
<?php }?>
    <div class="User">
      <img src="<?php echo Yii::getAlias('@web') . "/uploads/" . $user['photo'] ?>" alt="" class="rounded-circle">
      <p><?php echo $user['name']; ?></p>
      <h3><?php echo $user['user_name']; ?></h3>
      <p class="Title">Coder</p>
    </div>
    <nav class="EditProfile">
      <ul>
        <li><span class="Title">From </span> <span class="TitleBold"> <?php echo $user['city']; ?></span> </li>
        <li><span class="Title">Education </span> <span class="TitleBold"><?php echo $user['education']; ?></span> </li>
        <li><span class="Title">Work </span> <span class="TitleBold"><?php echo !empty($user['education']) ? $user['work'] : "-"; ?></span> </li>
        <li><span class="Title">Joined </span> <span class="TitleBold"><?php echo date("M Y", strtotime($user['created_at'])); ?></span> </li>
        <li><span class="TitleBold"> <?php echo Yii::$app->params['gender'][$user['gender']]; ?></span></li>
        <li> <span class="TitleBold"> 1988</span> </li>
        <li><span class="Title"> Remaining Number of Questions
          Allowed for the Week: </span> <span class="TitleBold">  <?php echo Common::get_remaining_questions_per_week($user_id); ?> out of 10</span> </li>
        </ul>
      </nav>
    </div>
    <div class="ListOfQuestions">
      <ul>
       <?php if ($user->role_id == Yii::$app->params['userroles']['user_agent']) {?>
      <li><a onclick="filterQuestion('myQue')"  href="#">Questions you have asked</a></li>
      <li><a onclick="filterQuestion('myLouder')" href="#">Questions you have made louder</a></li>
      <?php } else {?>
      <li><a onclick="filterQuestion('mpNotAns')" href="#">Questions you have not answered (for MPs)</a></li>
      <?php }?>
      </ul>
    </div>
  </div>
  <div class="modal fade Report" id="editProfile">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Edit profile</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <!-- Modal body -->
        <div class="modal-body">
         <!--  <form>
            <div class="form-group">
              <label>Work</label>
              <input type="text" class="form-control col-md-8" name="work" value="">
            </div>
            <div class="form-group">
              <label>Education</labe>
              <input type="text" name="work"  class="form-control  col-md-8" value="">
            </div>
            <div class="SubmitReport">
              <input type="button" name="save" class="SubmitReportBtn" value="save">
            </div>
          </form> -->
          <?php $model = Users::findOne(Yii::$app->user->id);?>
        <?php $form = ActiveForm::begin(['id' => 'profile-form', 'enableAjaxValidation' => true, 'enableClientValidation' => true/*, 'validationUrl' => Url::toRoute('site/index')*/]);?>
 <?=$form->field($model, 'education')->textArea(["class" => "form-control col-md-8 education_profile", 'value' => $model->education, "required" => true]);?>
 <?=$form->field($model, 'work')->textArea(["class" => "form-control col-md-8 work_profile", 'value' => $model->work, "required" => true]);?>

    <div class="form-group SubmitReport d-flex align-items-center justify-content-end">
      <?=Html::submitButton('Save', ['class' => 'btn btn-success SubmitReportBtn d-flex order-1', "onclick" => "editProfile(" . $_REQUEST['user_id'] . ")"])?>
    </div>
    <?php ActiveForm::end();?>
        </div>
      </div>
    </div>
  </div>