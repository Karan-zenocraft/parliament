<?php
use common\components\Common;
if (!empty($modelsQuestions)) {
    foreach ($modelsQuestions as $key => $question) {
        ?>
<div class="QuestionAnswerMainBox" id="questions_answers">
  <div class="Top"><a href="#"><span class="MPName">Ayele, Meskerem</span></a> and <a><span class="MPName OnhoverGroup">6 citizens you follow </span></a><span class="Title"> Commented or Made this Louder</span></div>
  <ul class="align-items-start justify-content-start flex-column OnhoverMP">
    <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li>
  </ul>
  <div class="QuestionAnswerBox">
    <div class="Row1">
      <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
        <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
          <?php
$user_image = !empty($question['userAgent']['photo']) ? Yii::getAlias('@web') . "/uploads/" . $question['userAgent']['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>
          <a href=" #"><img src="<?php echo $user_image; ?>" alt="" class="rounded-circle" width="47px" height="47px"></a>
          <div class="UserTitle">
            <a href="#"><p><?php echo $question['userAgent']['user_name'] ?></p></a>
            <span><?php echo Common::time_elapsed_string($question['created_at']); ?></span>
          </div>
        </div>
        <div class="UnansweredBy d-flex flex-wrap align-items-center">
          <a href="#"><span class="Title">Unanswered for</span></a>
          <?php $mps = $question['mp_id'];
        $mpArr = Common::getMpNames($mps);?>
          <a href="#"><span class="MP"><?php echo $mpArr; ?></span></a>
          <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
        </div>
        <div class="AskFollowUp d-flex flex-wrap align-items-center">
          <i class="fa fa-spinner" aria-hidden="true"></i>
          <span>ASK A FOLLOW UP</span>
        </div>
        <div class="ViewMoreIcon">
          <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/arrow-bottom.png" ?>" alt="" class="img-fluid ArrowBottom one" id="<?php echo $question['id']; ?>">
          <i class="fa fa-angle-down OnlySm ArrowBottom one" aria-hidden="true"></i>
          <div class="Menu1" id="<?php echo 'menu' . $question['id']; ?>">
            <ul class="d-flex align-items-center justify-content-center flex-column">
              <li class="active1"><a>Report</a></li>
              <li><a >Retract</a></li>
              <li><a >Hide</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="Row2">
      <div class="Comments">
        <?php $length = strlen($question['question']);
        if ($length <= 120) {?>
        <p> <?php echo $question['question']; ?></p>
        <?php } else {?>
        <p><?php echo substr($question['question'], 0, 120) ?></p>
        <p id="<?php echo "dots" . $question['id'] ?>">...</p>
        <p id="<?php echo "more" . $question['id'] ?>" class="more" style="display:none;"><?php echo substr($question['question'], 120, $length); ?></p>
        <button class="btn1" id="<?php echo "moreless" . $question['id'] ?>" data-val="<?php echo $question['id'] ?>">Read more</button>
        <?php }?>
      </div>
    </div>
    <div class="Row3">
      <div class="Social d-flex flex-wrap align-items-center justify-content-between">
        <div class="Loud" id="Load<?php echo $question['id']; ?>" data-myval="<?php echo $question['id']; ?>">
          <?php $louder_by = $question['louder_by'];
        ?>
          <a class="<?php echo (!empty($question['louder_by']) && in_array(Yii::$app->user->id, explode(",", $question['louder_by']))) ? 'MadeLouderBG' : '' ?>">
            <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
            <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
            <span class="Numbers numbers<?php echo $question['id']; ?>" id="numbers<?php echo $question['id']; ?>"><?php echo (empty($question['louder_by']) || ($question['louder_by'] == "")) ? "0" : count(explode(",", $question['louder_by'])); ?></span>
          </a>
        </div>
        <div class="Comments">
          <a href="#">
            <i class="fa fa-commenting-o" aria-hidden="true"></i>
            <span>Comment</span><span class="Numbers">100</span>
          </a>
        </div>
        <div class="Share">
          <a href="#">
            <i class="fa fa-share-alt" aria-hidden="true"></i>
            <span>Share</span><span class="Numbers">100</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
}}?>