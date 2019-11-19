<?php
use common\components\Common;
use common\models\Answers;
use common\models\Comments;
use common\models\QuestionReported;
use common\models\Shares;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
if (!empty($modelsQuestions)) {
    $user = Common::get_name_by_id(Yii::$app->user->id, "Users");
    foreach ($modelsQuestions as $key => $question) {
        ?>

<div class="QuestionAnswerMainBox" id="questions_answers<?php echo $question['id']; ?>">
<!--   <div class="Top"><a href="#"><span class="MPName">Ayele, Meskerem</span></a> and <a><span class="MPName OnhoverGroup">6 citizens you follow </span></a><span class="Title"> Commented or Made this Louder</span></div>
  <ul class="align-items-start justify-content-start flex-column OnhoverMP">
    <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li>
  </ul> -->

  <div class="QuestionAnswerBox" id="QuestionAnswerBox<?php echo $question['id'] ?>" style="border-color:<?php echo !empty($question['answers']) ? '#085820' : '#580816' ?> !important">
    <div class="Row1">
      <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
        <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
          <?php

        $user_image = !empty($question['userAgent']['photo']) ? Yii::getAlias('@web') . "/uploads/" . $question['userAgent']['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>
          <a href=" #"><img src="<?php echo $user_image; ?>" alt="" class="rounded-circle" width="47px" height="47px"></a>
          <div class="UserTitle">
            <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $question['userAgent']['id']; ?>"><p><?php echo $question['userAgent']['name'] ?></p></a>
            <span><?php echo Common::time_elapsed_string($question['created_at']); ?></span>
          </div>
        </div>
          <?php $mps = $question->mp_id;
        $answered_mp = (!empty($question['answers']) && (count($question['answers']) > 0)) ? array_column($question['answers'], 'mp_id') : [];
        $unanswered_by = array_diff(explode(",", $mps), array_unique($answered_mp));
        $first_mp_id = current($unanswered_by);
        $first_mp = Common::getMpNames(current($unanswered_by));
        $count = count($unanswered_by);
        $mpArr = Common::getMpNames(implode(",", $unanswered_by));
        if (empty($question['answers'])) {
            ?>
        <div class="UnansweredBy d-flex flex-wrap align-items-center" id="answered_by<?php echo $question['id']; ?>">
          <a href="#"><span class="Title">Unanswered for</span></a>
          <?php if ($count == 1) {
                ?>
          <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_id; ?>"><span class="MP"><?php echo $first_mp;
                ?></span></a>
                <?php $first_mp_detail = Common::get_name_by_id(current($unanswered_by), "Users");?>
               <?php $first_mp_image = !empty($first_mp_detail['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_mp_detail['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
          <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_mp_detail['photo']) ? $first_mp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
          <?php } else {
                ?>
            <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_id; ?>"><span class="MP"><?php echo $first_mp . " ";
                ?>and</span></a>
             <!--  <a><span class="MPName OnhoverGroup" onmouseleave="hide_mp_list('<?php echo $question['id'] ?>');" onmouseover="show_mp_list('<?php echo $question['id'] ?>');" id="<?php echo $question['id'] ?>"> <?php echo " " . ($count - 1); ?> others</span></a> -->
              <span class="MPName OnhoverGroup" onmouseover="show_mp_list('<?php echo $question['id'] ?>');" id="<?php echo $question['id'] ?>"> <?php echo " " . ($count - 1); ?> others

                  <ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMP<?php echo $question['id']; ?>">
          <?php
foreach ($unanswered_by as $key => $unanswer_mp) {
                    // p($unanswer_mp, 0);
                    echo "<li><a href=" . Yii::getAlias('@web') . "?user_id=" . $unanswer_mp . ">" . Common::get_user_name($unanswer_mp) . "</a></li>";
                }
                ?>
    <!-- <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li> -->
  </ul>

                  </span>
               <?php $first_mp_detail = Common::get_name_by_id(current($unanswered_by), "Users");?>
               <?php $first_mp_image = !empty($first_mp_detail['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_mp_detail['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
          <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_mp_detail['photo']) ? $first_mp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
            <?php }?>

<?php
$exclude_first = array_shift($unanswered_by);?>
            <div class="Absolute">
            <?php $i = 1;
            foreach ($unanswered_by as $key => $unanswer_mp) {
                $user_mp = Common::get_name_by_id($unanswer_mp, "Users");
                $user_mp_image = $user_mp['photo'];
                $user_mp_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user_mp['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
                ?>
            <img class="rounded-circle Img<?php echo $i; ?>" src="<?php echo $user_mp_image; ?>" alt="" class="img-fluid" width="24px" height="24px">
            <?php $i++;
            }?>
            </div>


          </a>

        </div>
      <?php } else {
            ?>
         <?php
$answered_mp_arr = array_unique($answered_mp);
            $count_answer = count(array_unique($answered_mp));
            ?>
              <div class="UnansweredBy d-flex flex-wrap align-items-center" id="answered_by<?php echo $question['id']; ?>">
          <a href="#"><span class="Title">Answered by</span></a>
                <?php $first_mp_answered_id = current($answered_mp);?>
          <?php if ($count_answer == 1) {
                ?>
          <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_answered_id; ?>"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id);
                ?></span></a>
                  <?php $first_ansmp_name = Common::get_name_by_id($first_mp_answered_id, "Users");
                $first_ansmp_image = !empty($first_ansmp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_ansmp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
                 <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_ansmp_name['photo']) ? $first_ansmp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
          <?php } else {
                ?>
            <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_answered_id; ?>"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id) . " ";
                ?>and



                </span></a>
              <a><span class="MPName OnhoverGroup" onmouseover="show_mp_list('<?php echo $question['id'] ?>');" id="<?php echo $question['id'] ?>"> <?php echo " " . ($count_answer - 1); ?> others




                  <ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMP<?php echo $question['id']; ?>">
          <?php
foreach ($ans_mps as $key => $ans_mp) {
                    echo "<li><a href=" . Yii::getAlias('@web') . "?user_id=" . $ans_mp . ">" . Common::get_user_name($ans_mp) . "</a></li>";
                }
                ?>
    <!-- <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li> -->
  </ul>


                  </span></a>
          <?php $first_ansmp_name = Common::get_name_by_id($first_mp_answered_id, "Users");
                $first_ansmp_image = !empty($first_ansmp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_ansmp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png";
                ?>
             <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_ansmp_name['photo']) ? $first_ansmp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
            <?php }?>

    <?php $ans_mps = array_unique($answered_mp);
            $exclude_first_answer = array_shift($ans_mps);
            ?>
            <div class="Absolute">
            <?php $i = 1;
            foreach ($ans_mps as $key => $ans_mp) {
                $ans_mp_name = Common::get_name_by_id($ans_mp, "Users");
                //$ans_mp_image = $ans_mp_name['photo'];
                $ans_mp_image = !empty($ans_mp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $ans_mp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
                ?>
            <img class="rounded-circle Img<?php echo $i; ?>" src="<?php echo $ans_mp_image; ?>" alt="" class="img-fluid rounded-circle" width="24px" height="24px">
            <?php $i++;
            }?>
            </div>
          </a>

        </div>
      <?php }?>
        <!-- <div class="AskFollowUp d-flex flex-wrap align-items-center">
          <i class="fa fa-spinner" aria-hidden="true"></i>
          <span>ASK A FOLLOW UP</span>
        </div> -->
        <div class="ViewMoreIcon">
          <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/arrow-bottom.png" ?>" alt="" class="img-fluid ArrowBottom one" id="<?php echo $question['id']; ?>">
          <i class="fa fa-angle-down OnlySm ArrowBottom one" aria-hidden="true" id="<?php echo $question['id']; ?>"></i>
          <div class="Menu1 menu_report" id="<?php echo 'menu' . $question['id']; ?>">
            <ul class="d-flex align-items-center justify-content-center flex-column">
              <?php $model = QuestionReported::find()->where(['question_id' => $question['id'], "user_id" => Yii::$app->user->id])->one();
        if (empty($model)) {?>
              <li class="active1" data-toggle="modal" data-target="#myModal<?php echo $question['id'] ?>"><a>Report</a></li>
            <?php }?>
              <?php if (($user->role_id == Yii::$app->params['userroles']['user_agent']) && ($question['user_agent_id'] == Yii::$app->user->id)) {?>
              <li><a id="<?php echo $question['id']; ?>" onclick="retract_question(id)">Retract</a></li>
            <?php }?>
              <li><a id="<?php echo $question['id']; ?>" onclick="hide_question(id)">Hide</a></li>
            </ul>
          </div>



<div class="modal fade Report" id="myModal<?php echo $question['id'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Report</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <?php
$model_report = new QuestionReported();
        $form4 = ActiveForm::begin(['id' => 'report', 'enableAjaxValidation' => true, 'enableClientValidation' => true, 'action' => "javascript:void(0);" /*, 'validationUrl' => Url::toRoute('site/index')*/]);?>

          <div class="form-group">
<?=$form4->field($model_report, 'report_comment')->textarea(['class' => 'form-control', "rows" => 5, 'placeholder' => 'Add a comment', "id" => "report" . $question['id']])->label(false);?>
 <div class="SubmitReport">
<?=Html::submitButton('Post', ["class" => "SubmitReportBtn", "id" => $question['id'], "onclick" => "reportQuestion(" . $question['id'] . ")"]);?></div>
   <!--  <div class="SubmitReport">
    <a href="" class="SubmitReportBtn" onclick="reportQuestion(id)" id="<?php echo $question['id'] ?>">Submit</a> -->

    </div>
</div>
<?php $form4->end();?>
 <!--  <label for="comment">Comment:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea> -->

        </div>
      </div>
    </div>




        </div>
      </div>
    </div>
    <div class="Row2">
      <div class="Comments">
        <p> <?php echo $question['question']; ?></p>
        <p id="<?php echo "more" . $question['id'] ?>" class="more" style="display:none;"></p>
                               <?php if (!empty($question['answers'])) {?>
                                 <p id="<?php echo "dots" . $question['id'] ?>">...</p>
        <button class="btn1" id="<?php echo "myBtn1" . $question['id'] ?>" data-val="<?php echo $question['id'] ?>" onclick="myFunction1(this.getAttribute('data-val'))">Read more</button>
      <?php }?>
      </div>
         <!---------new--------------------->
<?php
if (!empty($question['answers'])) {?>

<div class="Aarray example-1  scrollbar-dusty-grass square thin AnsweredByBox" id="more2<?php echo $question['id']; ?>">
<div id="answersList<?php echo $question['id']; ?>">
       <?php foreach ($question['answers'] as $key => $answer) {?>


                               <div class="">
                            <div class="Row1 AnsweredBy">
                                <div class="UnansweredBy d-flex flex-wrap align-items-center justify-content-end">
                                  <?php $mp = Common::get_name_by_id($answer['mp_id'], "Users");?>
                                   <a href="#"><span class="Title">Answered by</span></a><a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $mp->id; ?>"><span class="MP"><?php echo $mp->name; ?></span></a>
<?php $mp_user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $mp->photo : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>

                                   <a href="#"><img src="<?php echo $mp_user_image; ?>" alt="" class="rounded-circle" style="width:41px;height:41px;"></a>
                               </div>

                            </div>

                              <div class="Comments AnsweredByComments">
                            <p><?php echo $answer['answer_text']; ?></p>

                        </div>
                                </div>
                              <?php }?>
                            </div>
                                 <!---------new end--------------------->

    </div>
  <?php }?>

    </div>


      <div class="Row3">
      <div class="Social d-flex flex-wrap align-items-center justify-content-between">
        <?php if ($user->role_id == Yii::$app->params['userroles']['user_agent']) {
            ?>
        <div class="Loud" id="Load<?php echo $question['id']; ?>" data-myval="<?php echo $question['id']; ?>">
          <?php $louder_by = $question['louder_by'];
            ?>
          <a class="<?php echo (!empty($question['louder_by']) && in_array(Yii::$app->user->id, explode(",", $question['louder_by']))) ? 'MadeLouderBG' : '' ?>">
            <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
            <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
            <span class="Numbers numbers<?php echo $question['id']; ?>" id="numbers<?php echo $question['id']; ?>"><?php echo (empty($question['louder_by']) || ($question['louder_by'] == "")) ? "0" : count(explode(",", $question['louder_by'])); ?></span>
          </a>
        </div>
        <?php } else if (in_array($user->id, explode(",", $question['mp_id']))) {?>
        <div class="AnswerQuestion" id="<?php echo $question['id']; ?>" onclick="answer_toggle(id)">
          <a class="AnswerToggle">
            Answer Question
          </a>
        </div>
        <?php }?>
        <div class="Comments" id="<?php echo $question['id']; ?>" onclick= "show_comments(id)">
          <a>
            <i class="fa fa-commenting-o" aria-hidden="true"></i>
            <?php $comment_count = !empty($question['comments']) ? count($question['comments']) : 0;?>
            <span>Comment</span><span class="Numbers" id="comments<?php echo $question['id'] ?>"><?php echo $comment_count; ?></span>
          </a>
        </div>
       <!--  <div class="Share" id="<?php echo $question['id']; ?>">
        <?=\imanilchaudhari\socialshare\ShareButton::widget([
            'style' => 'horizontal',
            'networks' => ['facebook'],
            'data_via' => '', //twitter username (for twitter only, if exists else leave empty)
        ]);?>
        </div> -->

        <div class="Share" id="<?php echo $question['id']; ?>" onclick="facebook_share('<?php echo $question['id']; ?>')" data-question="<?php echo $question['question']; ?>">
            <i class="fa fa-share-alt" aria-hidden="true"></i>
            <?php $share_count = Shares::find()->where(['question_id' => $question['id']])->count();?>
            <span>Share</span><span class="Numbers"><?php echo ($share_count > 0) ? $share_count : 0 ?></span>
        </div>

<div class="modal fade Report" id="myModal<?php echo $question['id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h6 class="modal-title">Share on your facebook timeline</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="form-group">
  <label for="comment">Say something about this:</label>
  <textarea class="form-control" rows="5" id="comment"></textarea>

    <div class="SubmitReport">
    <a href="" class="SubmitReportBtn">Post</a>

    </div>
</div>
        </div>

        <!-- Modal footer -->
<!--
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
-->

      </div>
    </div>
  </div>


                                            </div>



      </div>
  </div>


</div>
 <div class="GiveAnswer CommentBox" id="CommentBox<?php echo $question['id']; ?>">

                             <div class="CommentsBox">
                                <div class="comments">
                                <div class="EnterComments d-flex align-items-center justifyu-content-center">
                                  <?php
$current_user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>
                                <img src="<?php echo $current_user_image; ?>" alt="" class="img-fluid">
                                 <?php $model_comment = new Comments();
        $form3 = ActiveForm::begin(['id' => 'comments', 'enableAjaxValidation' => true, 'enableClientValidation' => true, 'action' => "javascript:void(0);" /*, 'validationUrl' => Url::toRoute('site/index')*/]);?>

<?=$form3->field($model_comment, 'comment_text')->textInput(['class' => 'AddComment', 'placeholder' => 'Add a comment', "id" => "comment_text" . $question['id']])->label(false);?>
 <div class="form-group">
<?=Html::submitButton('<i class="fa fa-paper-plane"></i>', ["id" => $question['id'], "class" => "Okanswer", "onclick" => "submitComment(" . $question['id'] . ")"]);?></div>
<?php $form3->end();?>
                                <!-- <input type="text" class="AddComment" placeholder="Add a comment"> -->



                                </div>


                                </div>
                                <div class="Qarray example-1  scrollbar-dusty-grass square thin" id="commentArray<?php echo $question['id']; ?>">
                                <?php if (!empty($question['comments'])) {
            $comment_count = count($question['comments']);
            foreach ($question['comments'] as $key => $comment) {
                ?>
                                <ul class="CommentList">
                                <li class="d-flex align-items-start justify-content-start">
                                  <?php
$comment_user = Common::get_name_by_id($comment['user_agent_id'], "Users");
                $commented_user_image = !empty($comment_user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $comment_user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png;"?>
                                   <div class="CommentedProfile"> <img src="<?php echo $commented_user_image ?>" alt="" class="img-fluid"></div>
                                    <div class="Commented">
                                    <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $comment['user_agent_id']; ?>"><p class="CommentedUser"><?php echo Common::get_user_name($comment['user_agent_id']) ?></p></a>
                                    <p class="CommentedCaption"><?php echo $comment['comment_text']; ?></p>
                                    <!-- <div class="Social d-flex align-items-center justify-content-start">
                                        <div class="Like"><i class="fa fa-thumbs-up"></i><span class="First">Like</span><span>100</span></div>
                                        <div class="Reply"><i class="fa fa-reply"></i><span class="First">Reply</span></div>
                                    </div>
                                    </div> -->
                                </li>

                                </ul>
                              <?php }}?>
                                </div>
                                </div>
    </div>
<div class="GiveAnswer AnswerQuestionBox" id="AnswerQuestionBox<?php echo $question['id']; ?>">
  <div class="AskFollowUp">
    <div class="Profile">
      <?php $user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>
      <img src="<?php echo $user_image; ?>" alt="" class="rounded-circle AnswerImage">
      <div class="UserTitle">
        <a href="#"><p><?php echo $user['name'] ?></p></a>
      </div>
    </div>
    <div class="AskFollowUpTitle">
      <p>Answer Question</p>
    </div>
    <div class="AskFollowUpAnswerBox" >
      <?php $model_answer = new Answers();?>
<?php $form2 = ActiveForm::begin(['id' => 'answers-form', 'enableAjaxValidation' => true, 'enableClientValidation' => true/*, 'validationUrl' => Url::toRoute('site/index')*/]);?>
 <?=$form2->field($model_answer, 'answer_text')->textArea(['maxlength' => true, "class" => "AskQuestion model_answer" . $question['id'], "onkeyup" => "countCharanswer(this)", "id" => $question['id'], "data-val" => $question['id']])->label(false);?>

     <!--  <textarea id="getAnswer<?php echo $question['id']; ?>" maxlength="540"> </textarea> -->
    </div>
    <div class="form-group AskFollowUpSubmit d-flex align-items-center justify-content-end">
      <?=Html::submitButton('Submit', ['class' => 'btn btn-success AskButton d-flex order-1', "id" => $question['id'], "onclick" => "submitAnswer(" . $question['id'] . ")"])?>
      <div class="d-flex order-0 Charnum" id="charNum<?php echo $question['id']; ?>">0/540</div>
    </div>
    <!-- <div class="AskFollowUpSubmit">
      <a href="javascript:void(0)" onclick="submitAnswer(<?php echo $question['id']; ?>)">Submit</a></div> -->
    <?php ActiveForm::end();?>
    </div>
    <div id="disp<?php echo $question['id']; ?>"></div>
  </div>
  <?php
}}?>
<div id="fb-root"></div>
<script type="text/javascript">
window.fbAsyncInit = function() {
FB.init({appId: '465073670768272', status: true, cookie: true,
xfbml: true});
};
(function() {
var e = document.createElement('script'); e.async = true;
e.src = document.location.protocol +
'//connect.facebook.net/en_US/all.js';
document.getElementById('fb-root').appendChild(e);
}());
</script>