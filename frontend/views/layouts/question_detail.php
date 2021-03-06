<?php
use common\components\Common;
use frontend\assets\ParliamentAsset;
use yii\widgets\Breadcrumbs;

$this->registerCssFile('@web/themes/parliament_theme/css/inner-style.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/themes/parliament_theme/css/inner-responsive.css', ['depends' => [yii\web\JqueryAsset::className()]]);
ParliamentAsset::register($this);
$this->registerCssFile('@web/themes/parliament_theme/css/w3.css', ['depends' => [yii\web\JqueryAsset::className()]]);
//CommonAppAsset::register( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>
<?php $this->head();?>
<head>
    <title>Home Feed</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo1.png" ?>" type="image/png" sizes="64x64">
    <meta name="theme-color" content="#000" />
</head>

<body class="example-1  scrollbar-dusty-grass square thin">
<?php $this->beginBody()?>
    <a href="#" id="scroll" style="display: none;z-index: 99999;">
        <span></span></a>

<?php $user = Common::get_name_by_id(Yii::$app->user->id, "Users");

$user_image = !empty($user['photo']) ? Yii::getAlias('@web') . "/uploads/" . $user['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people-sm.png;"?>
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 HeaderTop d-flex align-items-center justify-content-center flex-wrap">
                    <h1>WE ARE THE PEOPLE. WE ARE THE PARLIAMENT.</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 HeaderBottomCenter d-flex align-items-center justify-content-center flex-wrap p-0">
                    <div class="Icons Icon col-md-3 p-0">
                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people.png" ?>" alt="" class="rounded-circle People">
                        <i class="fa fa-bell"></i>
                        <i class="fa fa-cog"></i>
                    </div>
                    <div class="col-md-6 p-0">
                       <div class="Search">
                        <input type="text" placeholder="Search for Questions here" class="SearchInput" id="filterSearch" onkeypress="filterSearch(event)"><i class="fa fa-search"></i>
                           </div>
                    </div>
                    <div class="Icons col-md-12 col-lg-3 p-lg-0 d-flex justify-content-end align-items-center">

                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo-sm.png" ?>" alt="" class="img-fluid OnlySm XsHidden">
                        <img src="<?php echo $user_image ?>" alt="" class="People rounded-circle" style="height: 108px;width: 108px;">
                        <i class="fa fa-rss-square ActiveIcon OnlySm"></i>
                        <span class="badge-Box"><i class="fa fa-bell"><span class="badge badge-secondary">1</span>
                        </i>
                        </span>
                        <ul class="Nav3">

                        <li class="d-flex align-items-center justify-content-between flex-wrap"><span>Notification</span> <span>Mark All as Unread</span></li>
                    <li><a href="">Chala Commented on your Question</a></li>
                    <li><a href="">Maya Made a Question Louder</a></li>
                      <li><a href="">Abebe Followed you</a></li>
                        <li><a href="">Lily Shared your Question</a></li>
                            <li><a href="">Chala Commented on your Question</a></li>
                            <li><a href="">Abebe Followed you</a></li>
                        <li><a href="">Lily Shared your Question</a></li>
                            <li class="text-center"><a href=""><b>See all</b></a></li>
                            </ul>
                        <i class="fa fa-search OnlySm"></i>
                        <i class="fa fa-cog"></i>
                        <!--new html-->

                        <ul class="Nav4">
                            <li class="BGList"><a href="<?php echo Yii::getAlias('@web') . "?user_id=" . Yii::$app->user->id; ?>">Edit profile</a></li>
                            <li><a href="site/logout">Log out</a></li>
                    </ul>

<!--end new html-->


                        <i class="fa fa-bars OnlySm"></i>
                    </div>
                        </div>
                </div>

        </div>
    </header>
    <section class="Main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 cus-md-3 MainLeft">

                </div>
                <div class="col-md-12 col-lg-6 cus-md-6 MainCenter">
                    <nav class="Nav1">


                        <ul class="d-flex align-items-center justify-content-between nav nav-tabs">
                            <li class="BGList"><a href="#home" onclick="filterQuestion('Homefeed')" data-toggle="tab" class="active show">Home Feed</a></li>
                            <li><a href="#home" data-toggle="tab" onclick="filterQuestion('Unanswered')" class="show">Unanswered</a></li>
                            <li><a href="#home" data-toggle="tab"  onclick="filterQuestion('Answered')" class="show">Answered</a></li>
                            <li><a href="#menu3"  data-toggle="tab"  id="citizen" onclick="AjaxCallSortCitizen()" class="show">Citizens</a></li>
                        </ul>
                    </nav>

                    <div class="tab-content clearfix">
                       <?php echo
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?><?php //echo Alert::widget() ?><?php echo $content ?>


                    </div>


                        <div id="menu1" class="tab-pane fade">
                           <!---------new-content-start----------------->

                            <div class="FilterBar SearchAnswredBar d-flex align-items-end justify-content-between">

                                <nav class="Nav2 Nav5">
                                    <ul class="d-flex align-items-center justify-content-start nav">
                                        <li class="FilterActive"><a>Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
                                       <li><a onclick="filterQuestion2('loudest')">Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>

                                    </ul>

                                </nav>
                                <div class="SearchMps SearchAnswredMps">
                                    <input type="search" placeholder="Search UnAnswered Questions" class="SearchMp AnswredQ"><i class="fa fa-search"></i>
                                </div>
                            </div>
                            <div class="QuestionAnswer">
<!-- QUESTIONS AND ANSWER SECTION START-->
                            <div class="QuestionAnswerTitle Public">
                            <h3>PUBLIC Questions</h3>
                            </div>
                            <input type='hidden' id='pageQuestion' value='0'>
                            <input type='hidden' id='questions_url' value="<?php echo Yii::getAlias("@web") . '/site/load-more-questions'; ?>">
                            <input type='hidden' id='filterQuestion2' value=''>
                            <div id='unanswered_questions'>
                            </div>
                            <br><center><button class="load_more" id="loadmoreDataunanswered" onclick="QuestionAnswer()" >Load More</button></center>
                            </div>

                            <!---------new-content-start----------------->


                        </div>
                        <div id="menu2" class="tab-pane fade">

                            <div class="FilterBar SearchAnswredBar d-flex align-items-end justify-content-between">

                                <nav class="Nav2 Nav5">
                                    <ul class="d-flex align-items-center justify-content-start nav">
                                        <li class="FilterActive"><a>Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
                                        <li><a onclick="filterQuestion2('loudest')">Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>

                                    </ul>

                                </nav>
                                <div class="SearchMps SearchAnswredMps">
                                    <input type="search" placeholder="Search Answered Questions" class="SearchMp SearchAnswredQ"><i class="fa fa-search"></i>
                                </div>
                            </div>
                            <div class="QuestionAnswer">
<!-- QUESTIONS AND ANSWER SECTION START-->
                            <div class="QuestionAnswerTitle Public">
                              <h3>PUBLIC Questions</h3>
                            </div>
                           <!--  <input type='hidden' id='pageQuestion' value='0'>
                            <input type='hidden' id='filterQuestion' value=''>
                            <input type="hidden" id='filterQuestion2' value=''> -->
                            <div id='answered_questions'>
                            </div>
                             <br><center><button class="load_more" id="loadmoreDataanswered" onclick="QuestionAnswer()" >Load More</button></center>
                            </div>
                        </div>

                        <div id="menu3" class="tab-pane fade">


                          <div class="FilterBar CitizenBar d-flex align-items-end justify-content-between">
                                <span>Filter: <i class="fa fa-angle-down OnlySm" aria-hidden="true"></i> </span>
                                <nav class="Nav2 Nav6">
                                       <ul class="d-flex align-items-center justify-content-start nav">
                                            <li class="FilterActive"><a onClick="AjaxCallSortCitizen('engagement')">Engagement </a></li>
                                            <li><a onClick="AjaxCallSortCitizen('city')" >Current City</a></li>
                                            <li><a onClick="AjaxCallSortCitizen('sex')">Sex</a></li>
                                            <li><a onClick="AjaxCallSortCitizen('age')">Age</a></li>
                                            <input type='hidden' id='sort_citizen' value='asc'>
                                            <input type='hidden' id='sortby_citizen' value=''>
                                            <input type='hidden' id='page_citizen' value='1'>
                                        </ul>


                                </nav>
                              <span>Show Citizens You follow</span>
                                <div class="SearchMps SearchCitizen">
                                    <input type="search" placeholder="Search Citizen" class="SearchMp Citizen" id="search_citizen" onkeypress="AjaxCallSearchCitizen(event)"><i class="fa fa-search"></i>
                                </div>
                            </div>
                            </div>
                            <div id="citizensList"></div>
                         <!--    <div class="CitizenPage">
                            <div class="Row1 d-flex align-items-center justify-content-start">
                            <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">


                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Followed"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                            <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">
                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Following"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                                <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">
                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Followed"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                            </div>

                                <div class="Row1 d-flex align-items-center justify-content-start">
                            <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">
                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Followed"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                            <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">
                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Following"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                                <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">
                            </div>
                            <div class="BlockCaption">
                                <h2>Meskrem Hailu</h2>
                                <p>Addis Ababa</p>
                                <p>Accountant</p>
                                <a class="Follow Followed"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                            </div>









                            <div class="SliderArrowCitizen">
                            <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="rounded-circle arrows arrows-right">


                               <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="rounded-circle arrows arrows-left">


                            </div>



                        </div> -->
                    </div>
                </div>
                <div class="col-md-3 cus-md-3 MainRight">
                    <nav>
                        <ul class="d=flex align-items-center justify-content=center flex-direction-column">
                            <li><a href="https://b4p.et/community-guidelines/">Community Guidelines </a></li>
                            <li><a href="https://b4p.et/announcements/">Announcements</a></li>
                            <li><a href="https://b4p.et/terms-of-use/">Terms of Use</a></li>
                            <li><a href="https://b4p.et/about-bridge">About Bridge</a></li>
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </section>
    <?php $this->endBody();?>
      <?php $this->endPage()?>
</body>

</html>
