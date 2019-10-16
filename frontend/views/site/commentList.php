<ul class="CommentList">
	<li class="d-flex align-items-start justify-content-start">
		<?php
$commented_user_image = !empty($comment_user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $comment_user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png;"?>
		<div class="CommentedProfile"> <img src="<?php echo $commented_user_image ?>" alt="" class="img-fluid"></div>
		<div class="Commented">
			<p class="CommentedUser"><?php echo $user_name; ?></p>
			<p class="CommentedCaption"><?php echo $comment; ?></p>
		<!-- 	<div class="Social d-flex align-items-center justify-content-start">
				<div class="Like"><i class="fa fa-thumbs-up"></i><span class="First">Like</span><span>100</span></div>
				<div class="Reply"><i class="fa fa-reply"></i><span class="First">Reply</span></div>
			</div> -->
		</div>
	</li>
</ul>