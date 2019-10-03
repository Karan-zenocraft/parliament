<?php
// use kartik\icons\FontAwesomeAsset;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

// FontAwesomeAsset::register($this);

?>
 <div id="home" class="tab-pane active show">
                            <div class="Ask">
                              <?php $form = ActiveForm::begin();?>

<?php
echo $form->field($model, 'mp_id')->widget(Select2::classname(), [
    'data' => $mp,
    'options' => ['placeholder' => 'Address for:', 'multiple' => true],
    'pluginOptions' => [
        'tags' => false,
        'tokenSeparators' => [',', ' '],
        'maximumInputLength' => 10,
    ],
])->label(false);

?>
  <?php //Html::activeHiddenInput($model, 'mp_id')?>

    <?=$form->field($model, 'mp_id')->hiddenInput(['placeholder' => "Address for: ", "class" => "Address"])->label(false);?>
    <?=$form->field($model, 'question')->textArea(['maxlength' => true, "class" => "AskQuestion", "placeholder" => "Ask your Question. Get involved", "onkeyup" => "countChar(this)"])->label(false);?>

   <div id="charNum" style="float: right;">0/540</div>
   <div class="form-group">
        <?=Html::submitButton('ASK', ['class' => 'btn btn-success AskButton'])?>
    </div>

  <?php ActiveForm::end();?>
      </div>

      <div class="FilterBar d-flex align-items-end justify-content-between">
          <span>Filter: </span>
          <nav class="Nav2">
              <ul class="d-flex align-items-center justify-content-start nav nav-tabs">
                  <li><a href="#Engagement" data-toggle="tab" class="active show" id="engagement">Engagement </a></li>
                  <li><a data-toggle="tab" href="#CurrentCity" class="show" id="CurrentCity">Current City</a></li>
                    <input type='hidden' id='sort' value='asc'>
                  <li><a data-toggle="tab" href="#Sex" class="show">Sex</a></li>
                  <li><a data-toggle="tab" href="#Age" class="show">Age</a></li>
              </ul>

          </nav>
          <div class="SearchMps">
              <input type="search" placeholder="Search MPs" class="SearchMp"><i class="fa fa-search"></i>
          </div>
      </div>


<div class="tab-content clearfix" id="mps">

<div id="Engagement" class="tab-pane active show">

<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner" id="mp_rows">

      <!------slider slide1------------>
 <?php Pjax::begin(['id' => 'menus', 'timeout' => 100000, 'enablePushState' => false]);?>
    <div class="carousel-item active">

  <div class="carousel-caption d-none d-md-block">

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
  <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
        'prevPageLabel' => '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>',
        'maxButtonCount' => 0,
        'options' => ['class' => 'prev_button carousel-control-prev Z-Index'],
    ]); ?>

  <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
        'nextPageLabel' => '<span class="carousel-control-next-icon" aria-hidden="true"></span>',
        'maxButtonCount' => 0,
        'options' => ['class' => 'carousel-control-next'],
    ]); ?>

<?php }?>
 <?php Pjax::end();?>
</div>
</div>
</div>
</div>
