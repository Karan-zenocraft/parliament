<?php
// use kartik\icons\FontAwesomeAsset;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

// FontAwesomeAsset::register($this);

?>
 <div id="home" class="tab-pane active show Flex">

                            <div class="Ask">
                                <?php $form = ActiveForm::begin(['id' => 'question-form', 'enableAjaxValidation' => true, 'enableClientValidation' => true, 'validationUrl' => Url::toRoute('site/index')]);?>
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
 <div id="charNum" style="float: right;">0/540</div>
  <div class="form-group">
        <?=Html::submitButton('ASK', ['class' => 'btn btn-success AskButton'])?>
    </div>
    <?php ActiveForm::end();?>
                            </div>

                            <div class="FilterBar d-flex align-items-end justify-content-between">
                                <span>Filter: <i class="fa fa-angle-down OnlySm" aria-hidden="true"></i> </span>
                                <nav class="Nav2">
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
                                <div class="SearchMps">
                                    <input type="search" value="" onBlur="AjaxCallSearch(this.value)" placeholder="Search MPs" id='searchMP' class="SearchMp"><i class="fa fa-search"></i>
                                </div>
                            </div>


                            <div class="tab-content clearfix">

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
          <div class="DimmerBox" id="<?php echo "mp_" . $value['id'] ?>"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage"></div>
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
  <span class="prev_button carousel-control-prev Z-Index" onclick="getPage('prev')"></span>
  <span class="sr-only">Previous</span>
  <span class="carousel-control-next-icon" onclick="getPage('next')" ></span>

<?php }?>
 <?php //Pjax::end();?>
</div>
</div>
</div>
</div>
