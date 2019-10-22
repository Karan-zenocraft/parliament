<?php
use common\components\Common;
use common\models\Questions;

$user = Common::get_name_by_id(Yii::$app->user->id, "Users");
$user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>

<a href="<?php echo Yii::getAlias('@web') ?>"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo"></a>
<div class="MainLeftInner">
	<?php if ($user->role_id == Yii::$app->params['userroles']['user_agent']) {
    ?>
	<div class="RemainingQuestion d-flex align-items-center justify-content=center">
		<img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/msg.png" ?>" alt="" class="img-fluid Msg">
		<?php
$questions = Questions::find()->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0])->count();
    ?>
		<p>Remaining Number of Questions
			Allowed for the Week
		<?php echo Common::get_remaining_questions_per_week(Yii::$app->user->id); ?> out of 10</p>
	</div>
	<?php if (!empty($questions)) {
        ?>
	<div class="LastQuestion">
		<p>Your last submitted Question</p>
		<div class="LastQuestionBox">
			<div class="Row1 d-flex align-items-center justify-content-between ">
				<div class="User d-flex align-items-center justify-content center">
					<img src="<?php echo $user_image; ?>" alt="" class="rounded-circle UserImage">
					<div class="ProfileName">
						<?php $question = Questions::find()->with('comments', 'answers')->where(["user_agent_id" => Yii::$app->user->id, "is_delete" => 0])->orderBy(["id" => SORT_DESC])->one();?>
						 <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . Yii::$app->user->id; ?>"><p><?php echo !empty($user) ? $user['user_name'] : "-" ?></p></a>
						<p><span><?php echo Common::time_elapsed_string($question->created_at); ?></span></p>
					</div>
				</div>
				<?php
$mps = $question['mp_id'];
        //  p($mps, 0);
        $answered_mp = !empty($question['answers']) ? array_column($question['answers'], 'mp_id') : [];
        // p($answered_mp, 0);
        $unanswered_by = array_diff(explode(",", $mps), $answered_mp);
        $first_mp = Common::getMpNames(current($unanswered_by));
        $count = count($unanswered_by);
        $mpArr = Common::getMpNames(implode(",", $unanswered_by));
        if (!empty($unanswered_by)) {

            ?>
				<div class="MP d-flex align-items-center justify-content center">
					<div class="MPProfileName">
						<span>Unanswered for</span>
						<span><?php if ($count == 1) {
                ?>
						<?php echo $first_mp; ?></span>
						<?php } else {?>
						<span><?php echo $first_mp; ?></span>
						<span>and </span>
						<span class="MPName OnhoverGroup" onmouseover="show_mp_list(id);" id="left"> <?php echo " " . ($count - 1); ?> others</span>
						<?php }?>
					</div>
					<?php $userDetails = Common::get_name_by_id(array_shift($unanswered_by), "Users");
            //p($userDetails . "1111111");?>
					<img src="<?php echo Yii::getAlias('@web') . "/uploads/" . $userDetails['photo'] ?>" alt="" class="rounded-circle MPImage">
					<ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMPleft" style="display: none;">
						<?php
$exclude_first = array_shift($unanswered_by);
            foreach ($unanswered_by as $key => $unanswer_mp) {
                echo "<li><a href='#'>" . Common::getMpNames($unanswer_mp) . "</a></li>";
            }
            ?>
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
							<span><?php echo $comment_count; ?></span>
						</a>
					</div>
					<div class="Share">
						<a href="#">
							<i class="fa fa-share-alt" aria-hidden="true"></i>
							<span>24</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php } else {?>
	<div class="LongTime">
		<p>It has been a long time
			since you asked a Question.
		Make your voice heard.</p>
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