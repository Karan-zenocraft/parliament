   <div class="">
                            <div class="Row1 AnsweredBy">
                                <div class="UnansweredBy d-flex flex-wrap align-items-center justify-content-end">
                                   <a href="#"><span class="Title">Answered by</span></a><a href="#"><span class="MP"><?php echo $user_name; ?></span></a>
                                   <?php $answered_user_image = !empty($answer_user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $answer_user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
                                   <a href="#"><img src="<?php echo $answered_user_image ?>" alt="" class="rounded-circle"></a>
                               </div>

                            </div>

                              <div class="Comments AnsweredByComments">
                            <p><?php echo $answer; ?></p>

                        </div>
                                </div>