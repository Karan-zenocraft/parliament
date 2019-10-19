<?php
use common\components\Common;
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
    <div class="EditProfiles"><a href="#" class="EditProfileBtn">EDIt</a></div>
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
        <li><span class="Title">Work </span> <span class="TitleBold"> Head of Accounting at AU</span> </li>
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
        <li><a href="#">Questions you have asked</a></li>
        <li><a href="#">Questions you have made louder</a></li>
        <li><a href="#">Questions you have not answered (for MPs)</a></li>
      </ul>
    </div>
  </div>