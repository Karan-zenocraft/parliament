<?php
use common\components\Common;
?>
<div id="home" class="tab-pane active show Flex">
<?php if (!empty($model)) {?>

                            <div class="QuestionAnswer">
                                <!-------box-2------------->
                                <div class="QuestionAnswerMainBox">
                                    <div class="QuestionAnswerBox">
                                        <div class="Row1">
                                            <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
                                                <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
       <?php $user_image = !empty($model->userAgent['photo']) ? Yii::getAlias('@web') . "/uploads/" . $model->userAgent['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>

                                                    <a href="#"><img src="<?php echo $user_image; ?>" alt="" class="img-fluid rounded-circle" width="47px" height="47px"></a>
                                                    <div class="UserTitle">
                                                        <a href="#">
                                                            <p><?php echo $model->userAgent->name; ?></p>
                                                        </a>
                                                        <span><?php echo Common::time_elapsed_string($model->created_at); ?></span>
                                                    </div>
                                                </div>

                                                <div class="ViewMoreIcon">
                                                    <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/arrow-bottom.png" ?>" alt="" class="img-fluid ArrowBottom">
                                                    <div class="Menu2">
                                                        <ul class="d-flex align-items-center justify-content-center flex-column">
                                                            <li class="active1"><a href="#">Report</a></li>
                                                            <li><a href="#">Retract</a></li>
                                                            <li><a href="#">Hide</a></li>


                                                        </ul>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
 <div class="Row2">
      <div class="Comments">
        <p> <?php echo $model->question; ?></p>
        <p id="<?php echo "more" . $model->id ?>" class="more" style="display:none;"></p>
                               <?php if (!empty($model->answers)) {?>
                                 <p id="<?php echo "dots" . $model->id ?>">...</p>
        <button class="btn1" id="<?php echo "myBtn1" . $model->id ?>" data-val="<?php echo $model->id ?>" onclick="myFunction1(this.getAttribute('data-val'))">Read more</button>
      <?php }?>
      </div>
         <!---------new--------------------->
<?php
if (!empty($model->answers)) {?>

<div class="AnsweredByBox" id="more2<?php echo $question['id']; ?>">
<div id="answersList<?php echo $question['id']; ?>">
       <?php foreach ($model->answers as $key => $answer) {?>


                               <div class="">
                            <div class="Row1 AnsweredBy">
                                <div class="UnansweredBy d-flex flex-wrap align-items-center justify-content-end">
                                  <?php $mp = Common::get_name_by_id($answer['mp_id'], "Users");?>
                                   <a href="#"><span class="Title">Answered by</span></a><a href="#"><span class="MP"><?php echo $mp->user_name; ?></span></a>
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
                                                <div class="Loud">
                                                    <a>
                                                        <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
                                                        <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
                                                        <span class="Numbers"><?php echo (empty($model->louder_by) || ($model->louder_by == "")) ? "0" : count(explode(",", $model->louder_by)); ?></span>
                                                    </a>
                                                </div>
                                                    <div class="Comments" id="<?php echo $model->id; ?>" onclick= "show_comments(id)">
          <a>
            <i class="fa fa-commenting-o" aria-hidden="true"></i>
            <?php $comment_count = !empty($model->comments) ? count($model->comments) : 0;?>
            <span>Comment</span><span class="Numbers" id="comments<?php echo $model->id ?>"><?php echo $comment_count; ?></span>
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

                            </div>
  <?php }?>

                        </div>