<meta property="og:url" content="http://ask.zenocraft.com" />
<meta property="og:type" content="website" />
<meta property="og:title"  content=" Notice of Passing" />
<meta property="og:description"   content="Notice of Passing " />
<meta property="og:image" content="http://ask.zenocraft.com/uploads/IMG-20180804-WA0001_5dab09cb6270f.jpg" />
<?php
// use kartik\icons\FontAwesomeAsset;
use common\components\Common;
use common\models\Questions;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// FontAwesomeAsset::register($this);
?>
<div id="homepage" class="tab-pane active show Flex"></div>
<div id="home" >
  <?php
$user = Common::get_name_by_id(Yii::$app->user->id, "Users");
if (($user->role_id == Yii::$app->params['userroles']['user_agent'])) {
    ?>
  <?php
//$mpArr = ArrayHelper::map(Users::find()->where(['role_id' => Yii::$app->params['userroles']['MP']])->orderBy('user_name')->asArray()->all(), 'id', 'user_name');
    $model = new Questions();
    ?>
  <div class="Ask hideHome">
    <?php $form = ActiveForm::begin(['id' => 'question-form' /*, 'action' => 'javascript:'*/]);?>
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
    <span class="mp_error" style="color:red;padding-left: 20px"></span>
    <?=$form->field($model, 'question')->textArea(['maxlength' => true, "class" => "AskQuestion", "placeholder" => "Ask your Question. Get involved", "onkeyup" => "countChar(this)"])->label(false);?>
    <span class="question_error" style="color:red;padding-left: 20px"></span>
    <div class="form-group d-flex align-items-center justify-content-end">
      <?=Html::submitButton('ASK', ['class' => 'btn btn-success AskButton d-flex order-1', "onclick" => 'submitQuestion(event)'])?>
      <div id="charNum" class="d-flex order-0" style="float: right;">0/540</div>
    </div>
    <?php ActiveForm::end();?>
  </div>
  <div class="hideHome FilterBar  align-items-end justify-content-between ">
    <span class="hideHome">Filter: <i class="fa fa-angle-down OnlySm" aria-hidden="true"></i> </span>
    <nav class="Nav2 hideHome">
      <ul class="align-items-center justify-content-start nav">
        <li class="FilterActive"><a onClick="AjaxCallSort('engagement')">Engagement </a></li>
        <li><a onClick="AjaxCallSort('city')" >Current City</a></li>
        <li><a onClick="AjaxCallSort('sex')">Sex</a></li>
        <li><a onClick="AjaxCallSort('age')">Age</a></li>
      </ul>
    </nav>
    <div class="SearchMps hideHome">
      <input type="text" value="" onkeypress="AjaxCallSearch(event)" placeholder="Search MPs" id='searchMP' class="SearchMp"><i class="fa fa-search" onclick="AjaxCallSearchClick(event)"></i>
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
                  <div class="RowBox d-flex align-items-center justify-content-start col-md-4 p-0 col-sm-4">
                    <?php $user_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png";?>
                    <div class="DimmerBox" id="<?php echo "mp_" . $value['id'] ?>"><img src="<?php echo $user_image; ?>" alt="" class="rounded-circle SliderImage"></div>
                   <div class="RowTitle">
                      <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $value['id']; ?>"> <p><?php echo $value['name']; ?></p>
                  </a>
                      <p><span><?php echo $value['standing_commitee']; ?><br>
                      Standing Committee</span></p>
                    </div>
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
<div class="FilterBar SearchAnswredBar  align-items-end justify-content-between">
<nav class="Nav2 Nav5 ">
  <ul class="d-flex align-items-center justify-content-start nav">
    <li class="FilterActive"><a onclick="filterQuestion2('recent')">Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
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
<?php if (!empty($_REQUEST['user_id'])) {?>
<input type='hidden' id='filterQuestion' value='profile'>
  <?php } else {?>
<input type='hidden' id='filterQuestion' value=''>
  <?php }?>
<input type='hidden' id='filterQuestion2' value=''>
<input type='hidden' id='sort' value='asc'>
<input type='hidden' id='sortby' value=''>
<input type='hidden' id='page' value='1'>
<input type='hidden' id='user_id' value="<?php echo !empty($_REQUEST['user_id']) ? $_REQUEST['user_id'] : Yii::$app->user->id ?>">
<div id='ajaxQuestion'>
</div>
<br><center><button class="load_more" id="loadmoreData" onclick="QuestionAnswer()" >Load More</button></center>

    <!---------new-content-end----------------->
  </div>