
<?php
// use kartik\icons\FontAwesomeAsset;
use common\components\Common;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// FontAwesomeAsset::register($this);
?>


<div id="home" class="tab-pane active show Flex">
  <?php
$user = Common::get_name_by_id(Yii::$app->user->id, "Users");
if ($user->role_id == Yii::$app->params['userroles']['user_agent']) {
    ?>

<?php// p($errors, 0);?>

  <div class="Ask hideHome">
    <?php $form = ActiveForm::begin(['id' => 'question-form']);?>
    <?php
echo $form->field($model, 'mp_id')->widget(Select2::classname(), [
        'data' => $mp,
        'name' => 'mp_id',
        'options' => ['placeholder' => 'Address for:', 'multiple' => true],
        'pluginOptions' => [
            'tags' => false,
            'tokenSeparators' => [',', ' '],
            'maximumInputLength' => 10,
        ],
    ])->label(false); ?>

    <?=$form->field($model, 'question')->textArea(['maxlength' => true, "class" => "AskQuestion", "placeholder" => "Ask your Question. Get involved", "onkeyup" => "countChar(this)"])->label(false);?>


    <div class="form-group d-flex align-items-center justify-content-end">
      <?=Html::submitButton('ASK', ['class' => 'btn btn-success AskButton d-flex order-1'])?>
      <div id="charNum" class="d-flex order-0" style="float: right;">0/540</div>
    </div>
    <?php ActiveForm::end();?>
  </div>
  <div class="hideHome FilterBar d-flex align-items-end justify-content-between ">
    <span class="hideHome">Filter: <i class="fa fa-angle-down OnlySm" aria-hidden="true"></i> </span>
    <nav class="Nav2 hideHome">
      <ul class="d-flex align-items-center justify-content-start nav">
        <li class="FilterActive"><a onClick="AjaxCallSort('engagement')">Engagement </a></li>
        <li><a onClick="AjaxCallSort('city')" >Current City</a></li>
        <li><a onClick="AjaxCallSort('sex')">Sex</a></li>
        <li><a onClick="AjaxCallSort('age')">Age</a></li>
        <input type='hidden' id='sort' value='asc'>
        <input type='hidden' id='sortby' value=''>
        <input type='hidden' id='page' value='1'>
      </ul>
    </nav>
    <div class="SearchMps hideHome">
      <input type="text" value="" onkeypress="AjaxCallSearch(event)" placeholder="Search MPs" id='searchMP' class="SearchMp"><i class="fa fa-search"></i>
    </div>
  </div>
  <div class="tab-content clearfix hideHome">
    <div id="Engagement" class="tab-pane active show">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" id="mp_rows">
          <?php //Pjax::begin(['id' => 'menus' /*,'timeout' => 100000, 'enablePushState' => false*/]);?>
          <!------slider slide1------------>
          <div class="carousel-item active">
            <div class="carousel-caption d-md-block">
              <div class="row" id="list_mp">
                <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
                  <?php if (!empty($models)) {
        $numOfCols = 3;
        $rowCount = 1;
        foreach ($models as $key => $value) {
            ?>
                  <div class="RowBox d-flex align-items-center justify-content-start col-md-4 p-0">
                    <?php $user_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png";?>
                    <div class="DimmerBox" id="<?php echo "mp_" . $value['id'] ?>"><img src="<?php echo $user_image; ?>" alt="" class="rounded-circle SliderImage"></div>
                    <a href="#"><div class="RowTitle">
                      <p><?php echo $value['user_name']; ?></p>
                      <p><span><?php echo $value['standing_commitee']; ?><br>
                      Standing Committee</span></p>
                    </div>
                  </a>
                </div>
                <?php if (($rowCount % $numOfCols == 0) && ($rowCount != $pagination->pageSize)) {
                echo '</div><div class="Row1 col-md-12 d-flex align-items-center justify-content-start">';
            }
            $rowCount++;
        }?>
            </div>
          </div>
        </div>
      </div>
    <!--   <span class="carousel-control-prev-icon" onclick="getPage('prev')" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
      <span class="carousel-control-next-icon" onclick="getPage('next')"  aria-hidden="true"></span> -->
      <div class="SliderArrowHomeFeed">
     <img class="Arrow_Left" src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>"  onclick="getPage('prev')" aria-hidden="true">
     <span class="sr-only">Previous</span>
     <img class="Arrow_Right" src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" onclick="getPage('next')"  aria-hidden="true">
       </div>
      <?php }?>
      <?php //Pjax::end();?>
    </div>
  </div>
</div>
</div>
<?php }?>

 <div class="FilterBar SearchAnswredBar d-flex align-items-end justify-content-between showHome" style="display:none !important ">
      <nav class="Nav2 Nav5 showHome">
          <ul class="d-flex align-items-center justify-content-start nav showHome">
              <li class="FilterActive"><a>Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
             <li><a onclick="filterQuestion2('loudest')">Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>
          </ul>
      </nav>
   <!--    <div class="SearchMps SearchAnswredMps">
          <input type="search" placeholder="Search UnAnswered Questions" class="SearchMp AnswredQ"><i class="fa fa-search"></i>
      </div> -->
  </div>

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
      <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="rounded-circle">
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
          <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="rounded-circle">
          <input type="text" class="AddComment" placeholder="Add a comment">
          <a href=""><i class="fa fa-paper-plane"></i></a>
        </div>
      </div>
      <ul class="CommentList">
        <li class="d-flex align-items-start justify-content-start">
          <div class="CommentedProfile"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png" ?>" alt="" class="rounded-circle"></div>
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
        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="rounded-circle">
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
            <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png" ?>" alt="" class="rounded-circle">
            <input type="text" class="AddComment" placeholder="Add a comment">
            <a href=""><i class="fa fa-paper-plane"></i></a>
          </div>
        </div>
        <ul class="CommentList">
          <li class="d-flex align-items-start justify-content-start">
            <div class="CommentedProfile"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/commented.png" ?>" alt="" class="rounded-circle"></div>
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