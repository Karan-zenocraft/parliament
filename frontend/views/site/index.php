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
  <span class="carousel-control-prev-icon" onclick="getPage('prev')" aria-hidden="true"></span>
  <span class="sr-only">Previous</span>
  <span class="carousel-control-next-icon" onclick="getPage('next')"  aria-hidden="true"></span>

<?php }?>
 <?php //Pjax::end();?>
</div>
</div>
</div>
</div>
<div class="QuestionAnswer">
                        <div class="QuestionAnswerTitle">
                        <h3>Questions and answers from members you follow</h3>
                        </div>

                    <div class="QuestionAnswerMainBox QuestionAnswerMainBox1">
<!--                            <span class="MPName">Kebede Hailu</span><span class="Title"> Answered a Question</span>-->
                        <div class="QuestionAnswerBox">

                           <div class="Row1">
                              <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
                            <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
                                <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                                <div class="UserTitle">
                                    <a href="#"><p>Meskrem Hailu</p></a>
                                    <span>1 hour ago</span>
                                </div>
                               </div>

                               <div class="UnansweredBy d-flex flex-wrap align-items-center">
                                   <a href="#"><span class="Title">Unanswered for</span></a><a href="#"><span class="MP">Cally Feeney</span></a>
                                   <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                               </div>

                               <div class="AskFollowUp d-flex flex-wrap align-items-center">
                                  <i class="fa fa-spinner" aria-hidden="true"></i>
                                   <span>ASK A FOLLOW UP</span>
                               </div>


                               <div class="ViewMoreIcon">
                                   <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/arrow-bottom.png" ?>" alt="" class="img-fluid ArrowBottom one">
                                   <i class="fa fa-angle-down OnlySm ArrowBottom one" aria-hidden="true"></i>
                                   <div class="Menu1">
                                   <ul class="d-flex align-items-center justify-content-center flex-column">
                                       <li class="active1"><a>Report</a></li>
                                       <li><a >Retract</a></li>
                                       <li><a >Hide</a></li>


                                    </ul>
                                   </div>
                               </div>

                                  </div>
                            </div>

                            <div class="Row2">

                            <div class="Comments">
                            <p>When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used</p>
                            <p id="dots1">...</p>
                            <p id="more1">When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used.....When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.</p>
                            <button onclick="myFunction1()" id="myBtn1">See More</button>




                        </div>
                            </div>

                            <div class="Row3">
                            <div class="Social d-flex flex-wrap align-items-center justify-content-between">
                                <div class="Loud" id="Load1">
                                <a>
                                    <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
                                    <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
                                    <span class="Numbers">301</span>
                                </a>
                                </div>

                                <div class="Comments">
                                    <a href="#">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    <span>Comment</span><span class="Numbers">100</span>
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



                            <!-------box-2------------->


                            <div class="QuestionAnswerMainBox">
                            <div class="Top"><a href=""><span class="MPName">Kebede Hailu</span></a><span class="Title"> Answered a Question</span></div>
                        <div class="QuestionAnswerBox">
                           <div class="Row1">
                              <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
                            <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
                                <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                                <div class="UserTitle">
                                    <a href="#"><p>Meskrem Hailu</p></a>
                                    <span>1 hour ago</span>
                                </div>
                               </div>

                               <div class="UnansweredBy d-flex flex-wrap align-items-center">
                                   <a href="#"><span class="Title">Answered by</span></a><a href="#"><span class="MP">Cally Feeney</span></a>
                                   <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                               </div>

                               <div class="AskFollowUp d-flex flex-wrap align-items-center">
                                  <i class="fa fa-spinner" aria-hidden="true"></i>
                                   <span>ASK A FOLLOW UP</span>
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
                            <p>When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used</p>
                            <p id="dots1">...</p>
                            <p id="more1">When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used.....When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.</p>
                            <button onclick="myFunction1()" id="myBtn1">See More</button>




                        </div>
                            </div>

                            <div class="Row3">
                            <div class="Social d-flex flex-wrap align-items-center justify-content-between">
                                <div class="Loud">
                                <a>
                                    <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
                                    <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
                                    <span class="Numbers">301</span>
                                </a>
                                </div>
                                <div class="Comments">
                                    <a href="#">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    <span>Comment</span><span class="Numbers">100</span>
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

                            <div class="QuestionAnswerTitle Public">
                        <h3>PUBLIC Questions</h3>
                        </div>
                           <div class="QuestionAnswerMainBox">
                            <div class="Top"><a href="#"><span class="MPName">Ayele, Meskerem</span></a> and <a><span class="MPName OnhoverGroup">6 citizens you follow </span></a><span class="Title"> Commented or Made this Louder</span></div>


                               <ul class="align-items-start justify-content-start flex-column OnhoverMP">
                                <li><a href="#">Abebe Mengistu</a></li>
                                   <li><a href="#">Taye Hailu</a></li>
                                   <li><a href="#">Kebede Taye</a></li>
                                   <li><a href="#">Mulu Saya</a></li>
                                   <li><a href="#">Chala Banti</a></li>
                                   <li><a href="#">Feven Siraj</a></li>
                                </ul>

                        <div class="QuestionAnswerBox">
                           <div class="Row1">
                              <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
                            <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
                                <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                                <div class="UserTitle">
                                    <a href="#"><p>Meskrem Hailu</p></a>
                                    <span>1 hour ago</span>
                                </div>
                               </div>

                               <div class="UnansweredBy d-flex flex-wrap align-items-center">
                                   <a href="#"><span class="Title">Unanswered for</span></a><a href="#"><span class="MP">Cally Feeney</span></a>
                                   <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                               </div>

                               <div class="AskFollowUp d-flex flex-wrap align-items-center">
                                  <i class="fa fa-spinner" aria-hidden="true"></i>
                                   <span>ASK A FOLLOW UP</span>
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
                            <p>When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used</p>
                            <p id="dots1">...</p>
                            <p id="more1">When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used.....When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.</p>
                            <button onclick="myFunction1()" id="myBtn1">See More</button>
                        </div>
                            </div>

                            <div class="Row3">
                            <div class="Social d-flex flex-wrap align-items-center justify-content-between">
                                <div class="Loud">
                                <a>
                                    <span class="MadeLouder">MADE LOUDER <i class="fa fa-wifi" aria-hidden="true"></i> </span>
                                    <i class="fa fa-wifi OnlySm" aria-hidden="true"></i>
                                    <span class="Numbers">301</span>
                                </a>
                                </div>
                                <div class="Comments">
                                    <a href="#">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    <span>Comment</span><span class="Numbers">100</span>
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

                           <div class="QuestionAnswerMainBox AnswerQuestion">

                        <div class="QuestionAnswerBox">
                           <div class="Row1">
                              <div class="d-flex flex-wrap align-items-center justify-content-between Row1Inner">
                            <div class="UserProfile d-flex flex-wrap align-items-center justify-content-start">
                                <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                                <div class="UserTitle">
                                    <a href="#"><p>Meskrem Hailu</p></a>
                                    <span>1 hour ago</span>
                                </div>
                               </div>

                               <div class="UnansweredBy d-flex flex-wrap align-items-center">
                                   <a href="#"><span class="Title">Unanswered for</span></a><a href="#"><span class="MP">Cally Feeney</span></a>
                                   <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid"></a>
                               </div>

                               <div class="AskFollowUp d-flex flex-wrap align-items-center">
                                  <i class="fa fa-spinner" aria-hidden="true"></i>
                                   <span>ASK A FOLLOW UP</span>
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
                            <p>When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used</p>
                            <p id="dots1">...</p>
                            <p id="more1">When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.  hope that I would not have a single bit of talent left and could say, I used.....When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me. When I stand before God at the end of my life, I would hope that I would not have a single bit of talent left and could say, I used everything you gave me.</p>
                            <button onclick="myFunction1()" id="myBtn1">See More</button>




                        </div>
                            </div>

                            <div class="Row3">
                            <div class="Social d-flex flex-wrap align-items-center justify-content-between">
                                <div class="AnswerQuestion">
                                <a class="AnswerToggle">
                                   Answer Question

                                </a>
                                </div>
                                <div class="Comments">
                                    <a href="#">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                                    <span>Comment</span><span class="Numbers">100</span>
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
