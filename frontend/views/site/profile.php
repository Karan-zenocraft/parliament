<?php
// use kartik\icons\FontAwesomeAsset;
// FontAwesomeAsset::register($this);
?>
<div id="home" class="tab-pane active show Flex">
<div class="QuestionAnswer">
<!-- QUESTIONS AND ANSWER SECTION START-->
<div class="QuestionAnswerTitle Public">
  <h3>PUBLIC Questions</h3>
</div>
<input type='hidden' id='pageQuestion' value='0'>
<input type='hidden' id='filterQuestion' value=''>
<div id='ajaxQuestion'>
</div>
 <br><center><button class="load_more" id="loadmoreData" onclick="QuestionAnswer()" >Load More</button></center>
<!-- QUESTIONS AND ANSWER SECTION END-->

<!---------new-content----------------->
<div class="GiveAnswer AskFollowUpBox">
  <div class="AskFollowUp">
    <div class="Profile">
      <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="img-fluid">
      <div class="UserTitle">
        <a href="#"><p>Fitsum Hailu</p></a>
      </div>
    </div>
    <div class="AskFollowUpTitle">
      <p>ask a follow up</p>
    </div>
    <div class="AskFollowUpAnswerBox">
      <textarea> </textarea>
    </div>
    <div class="AskFollowUpSubmit">
      <a href="" class="">Submit</a></div>
    </div>
    <div class="CommentsBox">
      <div class="comments">
        <div class="EnterComments d-flex align-items-center justifyu-content-center">
          <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="img-fluid">
          <input type="text" class="AddComment" placeholder="Add a comment">
          <a href=""><i class="fa fa-paper-plane"></i></a>
        </div>
      </div>
      <ul class="CommentList">
        <li class="d-flex align-items-start justify-content-start">
          <div class="CommentedProfile"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png" ?>" alt="" class="img-fluid"></div>
          <div class="Commented">
            <p class="CommentedUser">Abebe Kebede</p>
            <p class="CommentedCaption">sdkfhsdj sdkfjsdk sd; sdkjf asdkl fjasd;fjsd;kl fasd;klfjasd ;fjasdklfjas;kl fjas;dlfjasd;lk</p>
            <div class="Social d-flex align-items-center justify-content-start">
              <div class="Like"><i class="fa fa-thumbs-up"></i><span class="First">Like</span><span>100</span></div>
              <div class="Reply"><i class="fa fa-reply"></i><span class="First">Reply</span></div>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="GiveAnswer AnswerQuestionBox">
    <div class="AskFollowUp">
      <div class="Profile">
        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="img-fluid">
        <div class="UserTitle">
          <a href="#"><p>Fitsum Hailu</p></a>
        </div>
      </div>
      <div class="AskFollowUpTitle">
        <p>Answer Question</p>
      </div>
      <div class="AskFollowUpAnswerBox">
        <textarea> </textarea>
      </div>
      <div class="AskFollowUpSubmit">
        <a href="" class="">Submit</a></div>
      </div>
      <div class="CommentsBox">
        <div class="comments">
          <div class="EnterComments d-flex align-items-center justifyu-content-center">
            <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="img-fluid">
            <input type="text" class="AddComment" placeholder="Add a comment">
            <a href=""><i class="fa fa-paper-plane"></i></a>
          </div>
        </div>
        <ul class="CommentList">
          <li class="d-flex align-items-start justify-content-start">
            <div class="CommentedProfile"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png" ?>" alt="" class="img-fluid"></div>
            <div class="Commented">
              <p class="CommentedUser">Abebe Kebede</p>
              <p class="CommentedCaption">sdkfhsdj sdkfjsdk sd; sdkjf asdkl fjasd;fjsd;kl fasd;klfjasd ;fjasdklfjas;kl fjas;dlfjasd;lk</p>
              <div class="Social d-flex align-items-center justify-content-start">
                <div class="Like"><i class="fa fa-thumbs-up"></i><span class="First">Like</span><span>100</span></div>
                <div class="Reply"><i class="fa fa-reply"></i><span class="First">Reply</span></div>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!---------new-content-end----------------->
  </div>