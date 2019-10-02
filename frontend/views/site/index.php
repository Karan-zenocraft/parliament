<?php
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>
 <div id="home" class="tab-pane active show">
                            <div class="Ask">
                              <?php $form = ActiveForm::begin();?>
  <?php echo AutoComplete::widget([
    'name' => 'mp_id',
    'options' => [
        "class" => "Address",
    ],
    'clientOptions' => [
        'source' => $mp,
        'autoFill' => true,
        'select' => new JsExpression("function( event, ui ) {
        $('#questions-mp_id').val(ui.item.id);//#City-state_name is the id of hiddenInput.
     }")],
]); ?>
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
                                        <li><a data-toggle="tab" href="#CurrentCity" class="show">Current City</a></li>
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

      <div class="row">
           <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <?php if (!empty($models)) {
    $numOfCols = 3;
    $rowCount = 0;
    foreach ($models as $key => $value) {
        ?>
        <div class="RowBox d-flex align-items-center justify-content-start">
          <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p><?php echo $value['user_name']; ?></p>
            <p><span><?php echo $value['standing_commitee']; ?><br>
                Standing Committee</span></p>
                </div>
                </a>
          </div>
<?php $rowCount++;
        if ($rowCount % $numOfCols == 0) {
            echo '</div><div class="Row1 col-md-12 d-flex align-items-center justify-content-start">';
        }

    }?>

        <!-- </div> -->

      </div>
  </div>
</div>

  </div>
  <?php echo \yii\widgets\LinkPager::widget([
        'pagination' => $pagination,
        'prevPageLabel' => '<span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>',
        'maxButtonCount' => 0,
        'options' => ['class' => 'prev_button carousel-control-prev'],
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
