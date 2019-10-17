<?php
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

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 HeaderTop d-flex align-items-center justify-content-center flex-wrap">
                    <h1>WE ARE THE PEOPLE. WE ARE THE PARLIAMENT.</h1>
                </div>
            </div>
            <div class="row">


                <div class="col-md-12 HeaderBottomCenter d-flex align-items-center justify-content-center flex-wrap">
                    <div class="Icons Icon">
                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people.png" ?>" alt="" class="img-fluid People">
                        <i class="fa fa-bell"></i>
                        <i class="fa fa-cog"></i>
                    </div>


                    <div class="Search">
                        <input type="text" placeholder="Search for Questions here" class="SearchInput"><i class="fa fa-search"></i>
                    </div>



                    <div class="Icons">

                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo-sm.png" ?>" alt="" class="img-fluid OnlySm XsHidden">
                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people.png" ?>" alt="" class="img-fluid People">
                        <i class="fa fa-rss-square ActiveIcon OnlySm "></i>
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
                            <li class="BGList"><a>Edit profile</a></li>
                            <li><a>Log out</a></li>
                        </ul>

                        <!--end new html-->

                        <i class="fa fa-bars OnlySm"></i>
                    </div>







                </div>
            </div>

        </div>
    </header>
    <section class="Main MainEditProfile">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-lg-3 cus-md-3 MainLeft MainCenter">

                    <nav class="Nav1 OnlySm">
                        <ul class="d-flex align-items-center justify-content-between nav nav-tabs">
                            <li class="BGList"><a href="#home" data-toggle="tab" class="active show">Home Feed</a></li>
                            <li><a data-toggle="tab" href="#menu1" class="show">Unanswered</a></li>
                            <li><a data-toggle="tab" href="#menu2" class="show">Answered</a></li>
                            <li><a data-toggle="tab" href="#menu3" class="show">Citizens</a></li>
                        </ul>
                    </nav>

                    <a href="home.html"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo"></a>
                    <div class="MainLeftInner EditProfileMain">


                        <div class="ProfileLeft">
                        <div class="EditProfiles"><a href="#" class="EditProfileBtn">EDIt</a></div>
                            <div class="User">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/people.png" ?>" alt="" class="rounded-circle">
                                <p>@Fithailu</p>
                                <h3>Fitsum Hailu</h3>
                                <p class="Title">Coder</p>
                            </div>

                            <nav class="EditProfile">
                                <ul>
                                    <li><span class="Title">From </span> <span class="TitleBold"> Addis Ababa Ethiopia</span> </li>


                                    <li><span class="Title">Education </span> <span class="TitleBold"> Accounting (BA) from JU</span> </li>


                                    <li><span class="Title">Work </span> <span class="TitleBold"> Head of Accounting at AU</span> </li>
                                    <li><span class="Title">Joined </span> <span class="TitleBold"> August 2019</span> </li>
                                    <li><span class="TitleBold"> Female</span> </li>
                                    <li> <span class="TitleBold"> 1988</span> </li>
                                    <li><span class="Title"> Remaining Number of Questions
                                            Allowed for the Week: </span> <span class="TitleBold"> 1 out of 10</span> </li>

                                </ul>

                            </nav>

                        </div>



                        <div class="ListOfQuestions">
                            <ul>
                                <li><a href="#">Questions you have asked</a></li>
                                <li><a href="#">Questions you have made louder</a></li>
                                <li><a href="#">Questions you have not answered (for MPs)</a></li>
                            </ul>

                        </div>



                    </div>
                </div>
                <div class="col-md-12 col-lg-6 cus-md-6 MainCenter">
                    <nav class="Nav1 Onlylg">


                        <ul class="d-flex align-items-center justify-content-between nav nav-tabs">
                            <li class="BGList"><a href="#home" class="active show">Home Feed</a></li>
                            <li><a data-toggle="tab" href="#menu1" class="show">Unanswered</a></li>
                            <li><a data-toggle="tab" href="#menu2" class="show">Answered</a></li>
                            <li><a data-toggle="tab" href="#menu3" class="show">Citizens</a></li>
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
                                        <li><a>Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>

                                    </ul>

                                </nav>
                                <div class="SearchMps SearchAnswredMps">
                                    <input type="search" placeholder="Search Answered Questions" class="SearchMp SearchAnswredQ"><i class="fa fa-search"></i>
                                </div>
                            </div>

                            <!---------new-content-start----------------->


                        </div>
                        <div id="menu2" class="tab-pane fade">

                            <div class="FilterBar SearchAnswredBar d-flex align-items-end justify-content-between">

                                <nav class="Nav2 Nav5">
                                    <ul class="d-flex align-items-center justify-content-start nav">
                                        <li class="FilterActive"><a>Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
                                        <li><a>Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>

                                    </ul>

                                </nav>
                                <div class="SearchMps SearchAnswredMps">
                                    <input type="search" placeholder="Search Answered Questions" class="SearchMp SearchAnswredQ"><i class="fa fa-search"></i>
                                </div>
                            </div>
                            <h1>three</h1>
                        </div>

                        <div id="menu3" class="tab-pane fade">


                            <div class="FilterBar CitizenBar d-flex align-items-end justify-content-between">
                                <span>Filter: <i class="fa fa-angle-down OnlySm" aria-hidden="true"></i> </span>
                                <nav class="Nav2 Nav6">
                                    <ul class="d-flex align-items-center justify-content-start nav Nav6Ul">
                                        <li class="FilterActive"><a>Engagement </a></li>
                                        <li><a>Current City</a></li>
                                        <li><a>Sex</a></li>
                                        <li><a>Age</a></li>
                                    </ul>

                                </nav>
                                <span>Show Citizens You follow</span>
                                <div class="SearchMps SearchCitizen">
                                    <input type="search" placeholder="Search Citizen" class="SearchMp Citizen"><i class="fa fa-search"></i>
                                </div>
                            </div>

                            <div class="CitizenPage">
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
                                    <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="img-fluid arrows arrows-right">
                                    <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="img-fluid arrows arrows-left">

                                </div>
                            </div>



                        </div>










                    </div>
                </div>
                <div class="col-md-3 cus-md-3 MainRight">
                    <nav>
                        <ul class="d=flex align-items-center justify-content=center flex-direction-column">
                            <li><a href="#">Community Guidelines </a></li>
                            <li><a href="#">Announcements</a></li>
                            <li><a href="#">Terms of Use</a></li>
                            <li><a href="#">About Bridge</a></li>
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
