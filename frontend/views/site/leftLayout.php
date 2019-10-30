<?php
use common\components\Common;
use common\models\Questions;
use common\models\Shares;

$user = Common::get_name_by_id(Yii::$app->user->id, "Users");
$user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>

<a href="<?php echo Yii::getAlias('@web') ?>"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo"></a>
<div class="MainLeftInner">
	<?php if ($user->role_id == Yii::$app->params['userroles']['user_agent']) {
    ?>
	<div class="RemainingQuestion d-flex align-items-center justify-content=center">
		<img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/msg.png" ?>" alt="" class="img-fluid Msg">
		<?php
//$questions = Questions::find()->with('answers')->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0])->count();
    ?>
		<p>Remaining Number of Questions
			Allowed for the Week
		<?php echo Common::get_remaining_questions_per_week(Yii::$app->user->id); ?> out of 10</p>
	</div>
<?php $question = Questions::find()->with('comments', 'answers')->where(["user_agent_id" => Yii::$app->user->id, "is_delete" => 0])->orderBy(["id" => SORT_DESC])->one();?>
	<?php if (!empty($question)) {
        ?>
	<div class="LastQuestion">
		<p>Your last submitted Question</p>
		<div class="LastQuestionBox" style="border-color:<?php echo !empty($question['answers']) ? '#085820' : '#580816' ?> !important">
			<div class="Row1 d-flex align-items-center justify-content-between ">
				<div class="User d-flex align-items-center justify-content center">
					<img src="<?php echo $user_image; ?>" alt="" class="rounded-circle UserImage">
					<div class="ProfileName">
						 <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . Yii::$app->user->id; ?>"><p><?php echo !empty($user) ? $user['user_name'] : "-" ?></p></a>
						<p><span><?php echo Common::time_elapsed_string($question->created_at); ?></span></p>
					</div>
				</div>
				<?php $mps = $question->mp_id;
        $answered_mp = (!empty($question['answers']) && (count($question['answers']) > 0)) ? array_column($question['answers'], 'mp_id') : [];
        $unanswered_by = array_diff(explode(",", $mps), array_unique($answered_mp));
        $first_mp = Common::getMpNames(current($unanswered_by));
        $count = count($unanswered_by);
        $mpArr = Common::getMpNames(implode(",", $unanswered_by));
        if (empty($question['answers'])) {
            ?>
        <div class="MP d-flex align-items-center justify-content center">
          <div class="MPProfileName">
         <span class="Title">Unanswered for</span>
          <?php if ($count == 1) {
                ?>
          <a href="#"><span class="MP"><?php echo $first_mp;
                ?></span></a>
          <?php } else {
                ?>
            <a href="#"><span class="MP"><?php echo $first_mp . " ";
                ?>and</span></a>
              <a><span class="MPName OnhoverGroup" onmouseleave="hide_mp_list(id)" onmouseover="show_mp_list(id)" id="left"> <?php echo " " . ($count - 1); ?> others</span></a>
            <?php }?>
          <a href="#" class="UsersImg"><img class="One" src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid">
            <div class="Absolute">
<?php $exclude_first = array_shift($unanswered_by);?>
            <?php $i = 1;
            foreach ($unanswered_by as $key => $unanswer_mp) {
                $user_mp = Common::get_name_by_id($unanswer_mp, "Users");
                $user_mp_image = $user_mp['photo'];
                $user_mp_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user_mp['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
                ?>
            <img class="Img<?php echo $i; ?>" src="<?php echo $user_mp_image; ?>" alt="" class="img-fluid">
            <?php $i++;
            }?>
            </div>
          </div>



          </a>
          <ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMPleft" style="display: none;">
          <?php
foreach ($unanswered_by as $key => $unanswer_mp) {
                echo "<li><a href='#'>" . Common::getMpNames($unanswer_mp) . "</a></li>";
            }
            ?>
    <!-- <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li> -->
  </ul>
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
          <a href="#"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id);
                ?></span></a>
          <?php } else {
                ?>
            <a href="#"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id) . " ";
                ?>and</span></a>
              <a><span class="MPName OnhoverGroup" onmouseleave="hide_mp_list(id);" onmouseover="show_mp_list(id);" id="left"> <?php echo " " . ($count_answer - 1); ?> others</span></a>
            <?php }
            $first_ansmp_name = Common::get_name_by_id($first_mp_answered_id, "Users");
            $first_ansmp_image = !empty($first_ansmp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_ansmp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
            ?>

<?php $exclude_first_answer = array_shift($answered_mp);
            //p(array_unique($answered_mp), 0);
            ?>

            <div class="Absolute">
            <?php $i = 1;
            foreach ($answered_mp as $key => $ans_mp) {
                $ans_mp_name = Common::get_name_by_id($ans_mp, "Users");
                //$ans_mp_image = $ans_mp_name['photo'];
                $ans_mp_image = !empty($ans_mp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $ans_mp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
                ?>
            <img class="Img<?php echo $i; ?>" src="<?php echo $ans_mp_image; ?>" alt="" class="img-fluid rounded-circle" width="24px" height="24px">
            <?php $i++;
            }?>
            </div>
          </a>
          <ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMPleft" style="display: none;">
          <?php
foreach (array_unique($answered_mp) as $key => $answered_mp) {
                echo "<li><a href='#'>" . Common::getMpNames($answered_mp) . "</a></li>";
            }
            ?>
    <!-- <li><a href="#">Abebe Mengistu</a></li>
    <li><a href="#">Taye Hailu</a></li>
    <li><a href="#">Kebede Taye</a></li>
    <li><a href="#">Mulu Saya</a></li>
    <li><a href="#">Chala Banti</a></li>
    <li><a href="#">Feven Siraj</a></li> -->
  </ul>
        </div>
      <?php }?>
			</div>
			<div class="Row2">
				<div class="Comments">
					<?php $length = strlen($question['question']);
        if ($length <= 70) {?>
					<p> <?php echo $question['question']; ?></p>
					<?php } else {?>
					<p><?php echo substr($question['question'], 0, 70) ?></p>
					<p id="dotsleft">...</p>
					<p id="moreleft" class="moreleft" style="display:none;"><?php echo substr($question['question'], 71, $length); ?></p>
					<button class="btnleft" id="<?php echo $question['id'] ?>">Read more</button>
					<?php }?>
				</div>
			</div>
			<div class="Row3">
				<div class="Social d-flex align-items-center justify-content-between">
					<div class="Loud <?php echo (!empty($question['louder_by']) && in_array(Yii::$app->user->id, explode(",", $question['louder_by']))) ? 'LoadBG' : '' ?>" id="Load2" data-question="<?php echo $question['id']; ?>">
						<i class="fa fa-wifi" aria-hidden="true"></i>
						<span id="Load2_count"><?php echo (empty($question['louder_by']) || ($question['louder_by'] == "")) ? "0" : count(explode(",", $question['louder_by'])); ?></span>
					</div>
					<div class="Comment">
						<a href="#">
							<i class="fa fa-commenting-o" aria-hidden="true"></i>
							<?php $comment_count = !empty($question['comments']) ? count($question['comments']) : 0;?>
							<span id="comment_count_left<?php echo $question['id'] ?>"><?php echo $comment_count; ?></span>
						</a>
					</div>
					<div class="Share">
						<a href="#">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
							<?php $share_count = Shares::find()->where(['question_id' => $question['id']])->count();?>
							<span><?php echo $share_count; ?></span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } else {?>
	<div class="LongTime">
		<p>Ask Questions , Get your voice heard.</p>
	</div>
	<?php }}?>
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