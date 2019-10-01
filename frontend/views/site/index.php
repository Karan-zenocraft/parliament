<?php
use yii\helpers\Html;
use yii\jui\AutoComplete;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;
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
                               <!--  <input type="text" placeholder="Address for: " class="Address">
                                <input type="text" placeholder="Ask your Question. Get involved" class="AskQuestion">

                                <a href="#" class="AskButton">ASK</a> -->
                            </div>

                            <div class="FilterBar d-flex align-items-end justify-content-between">
                                <span>Filter: </span>
                                <nav class="Nav2">
                                    <ul class="d-flex align-items-center justify-content-start nav nav-tabs">
                                        <li><a href="#Engagement" data-toggle="tab" class="active show">Engagement </a></li>
                                        <li><a data-toggle="tab" href="#CurrentCity" class="show">Current City</a></li>
                                        <li><a data-toggle="tab" href="#Sex" class="show">Sex</a></li>
                                        <li><a data-toggle="tab" href="#Age" class="show">Age</a></li>
                                    </ul>

                                </nav>
                                <div class="SearchMps">
                                    <input type="search" placeholder="Search MPs" class="SearchMp"><i class="fa fa-search"></i>
                                </div>
                            </div>


                            <div class="tab-content clearfix">

                                <div id="Engagement" class="tab-pane active show">

                                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">

      <!------slider slide1------------>
    <div class="carousel-item active">

  <div class="carousel-caption d-none d-md-block">


      <div class="row">
           <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <?php if (!empty($mp)) {
    foreach ($mp as $key => $value) {?>
        <div class="RowBox d-flex align-items-center justify-content-start">
          <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p><?php echo $value['value']; ?></p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
                </a>
          </div>
<!--
          <div class="RowBox d-flex align-items-center justify-content-start">
          <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide3.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div> -->

         <?php
}
}?>
        </div>

    <!--   <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide4.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide5.png" ?>" alt="" class="img-fluid SliderImage"></div>
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide6.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div> -->

        <!--   <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide7.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide8.png" ?>" alt="" class="img-fluid SliderImage"></div>
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide9.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div> -->



       <!--    <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide10.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide11.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide12.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div> -->

      </div>
  </div>
</div>



      <!------slider slide2------------>
<!--     <div class="carousel-item ">

  <div class="carousel-caption d-none d-md-block">


      <div class="row">

           <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
                </a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide2.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide3.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div>

        </div>

      <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide4.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide5.png" ?>" alt="" class="img-fluid SliderImage"></div>
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide6.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>

          <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide7.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide8.png" ?>" alt="" class="img-fluid SliderImage"></div>
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide9.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>



          <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
            <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide10.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide11.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
              <div class="DimmerBox"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide12.png" ?>" alt="" class="img-fluid SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>

      </div>
  </div>
</div> -->


       <!------slider slide3------------>
<!--
    <div class="carousel-item ">

  <div class="carousel-caption d-none d-md-block">


      <div class="row">

           <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png" ?>" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
                </a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide2.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide3.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div>
              </a>
          </div>

        </div>

      <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide4.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide5.png" alt="" class="img-fluid SliderImage">
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide6.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>

          <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide7.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide8.png" alt="" class="img-fluid SliderImage">
           <a href="#"> <div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
               </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide9.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>



          <div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
        <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide10.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide11.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

          <div class="RowBox d-flex align-items-center justify-content-start">
          <img src="../image/slide12.png" alt="" class="img-fluid SliderImage">
            <a href="#"><div class="RowTitle">
            <p>Cally Feeney</p>
            <p><span>Foreign Relations & Peace <br>
                Standing Committee</span></p>
                </div></a>
          </div>

        </div>

      </div>
  </div>
</div>
-->





  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


                                </div>

                                <div id="CurrentCity" class="tab-pane fade">
                                    <h1>two</h1>
                                </div>
                                <div id="Sex" class="tab-pane fade">
                                    <h1>three</h1>
                                </div>

                                <div id="Age" class="tab-pane fade">
                                    <h1>four</h1>
                                </div>


                            </div>