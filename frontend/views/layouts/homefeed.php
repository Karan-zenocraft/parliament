<?php
use common\components\Common;
use common\models\Notifications;
use frontend\assets\ParliamentAsset;
use frontend\components\HelloWidget;
use frontend\components\ProfilePage;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;

$this->registerCssFile('@web/themes/parliament_theme/css/inner-style.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/themes/parliament_theme/css/inner-responsive.css', ['depends' => [yii\web\JqueryAsset::className()]]);
ParliamentAsset::register($this);
$this->registerCssFile('@web/themes/parliament_theme/css/w3.css', ['depends' => [yii\web\JqueryAsset::className()]]);
//CommonAppAsset::register( $this );
?>
<?php //echo Url::base('');die(); ?>
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
    <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.21.7.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>

<div id="overlay" style="display: none;">
  <div class="load__container">
      <div class="load__animation d-flex align-items-center justify-content-center">
      <lottie-player
  src="https://assets2.lottiefiles.com/datafiles/slaclXQr9VF4vv1/data.json"  background="transparent"  speed="1"  style="width: 60px; height: 60px;"  loop autoplay >
</lottie-player>
      </div>


      <div class="load__mask"></div>
    </div>
</div>
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
                    <div class="col-md-12 col-lg-6 p-0">
                       <div class="Search">
                        <input type="text" placeholder="Search for Questions here" class="SearchInput" id="filterSearch" onkeypress="filterSearch(event)"><i class="fa fa-search" onclick="filterSearchClick(event)"></i>
                           </div>
                    </div>
                    <div class="Icons col-md-12 col-lg-3 p-lg-0 d-flex justify-content-end align-items-center">

                        <a style="z-index:99;" href="<?php echo Yii::getAlias('@web') ?>"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo-sm.png" ?>" alt="" class="img-fluid OnlySm XsHidden"></a>
                        <a style="z-index:99;" href="<?php echo Yii::getAlias('@web') . "?user_id=" . Yii::$app->user->id ?>"><img src="<?php echo $user_image ?>" alt="" class="People rounded-circle" style="height: 108px;width: 108px;"></a>

                         <?php if (!empty($_REQUEST['user_id'])) {?>
                        <a href="<?php echo Url::base(''); ?>#Homefeed" onclick="filterQuestion('Homefeed')" class="show">
                        <i class="fa fa-rss-square ActiveIcon OnlySm"></i>
                        </a>
                        <?php } else {?>
                           <a href="#Homefeed" onclick="filterQuestion('Homefeed')" data-toggle="tab" class="active">
                        <i class="fa fa-rss-square ActiveIcon OnlySm"></i>
                        </a>
                        <?php }?>

                        <?php $notifications = Notifications::find()->where(['user_id' => Yii::$app->user->id, 'mark_read' => 0])->orderBy(['id' => SORT_DESC])->asArray()->all();?>
                        <span class="badge-Box"><i class="fa fa-bell"><span class="badge badge-secondary"><?php echo !empty($notifications) ? count($notifications) : 0 ?></span>
                        </i>
                        </span>

                        <i class="fa fa-search OnlySm"></i>
                        <i class="fa fa-cog"></i>
                        <!--new html-->

                        <ul class="Nav4">
                            <li class="BGList"><a href="<?php echo Yii::getAlias('@web') . "?user_id=" . Yii::$app->user->id; ?>">Edit profile</a></li>
                            <!--  <li><a href="<?php //echo Yii::$app->urlManager->createUrl(['site/change-password']); ?>">Change Password</a></li> -->
                            <li><a href="site/logout">Log out</a></li>
                    </ul>
<!--end new html-->
                        <i class="fa fa-bars OnlySm"></i>
                    </div>



                    <div class="Nav3" >
                        <div class="d-flex align-items-center justify-content-between flex-wrap"><span>Notification</span> <a href="javascript:void(0);" onclick="clear_notification(<?php echo Yii::$app->user->id; ?>)"><span>Mark All as Unread</span></a></div>

                        <ul class="example-1  scrollbar-dusty-grass square thin dynamic_notification" style="list-style-type: none;padding: 0;margin-bottom: 0px;max-height: 220px;overflow-y: scroll;overflow-x: auto;width:100%;background:#D5D5D5">
<?php if (!empty($notifications)) {
    foreach ($notifications as $key => $notification) {
        echo "<li><a href=''> " . $notification['notification'] . " </a></li>";
    }

}

?>
                <!--     <li><a href="">Chala Commented on your Question</a></li>
                    <li><a href="">Maya Made a Question Louder</a></li>
                      <li><a href="">Abebe Followed you</a></li>
                        <li><a href="">Lily Shared your Question</a></li>
                            <li><a href="">Chala Commented on your Question</a></li>
                            <li><a href="">Abebe Followed you</a></li>
                        <li><a href="">Lily Shared your Question</a></li> -->

                        </ul>

                        <!-- <div class="text-center"><a href=""><b>See all</b></a></div> -->

                            </div>

                </div>

        </div>
    </header>
    <section class="Main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12 cus-md-3 MainLeft">
                <?php //p($_REQUEST);
if (empty($_REQUEST['user_id'])) {?>
                    <?php echo HelloWidget::widget(); ?>
                <?php } else {?>
                    <?php echo ProfilePage::widget(); ?>
                <?php }?>
                </div>
                <div class="col-md-12 col-lg-6 cus-md-6 MainCenter">
                    <nav class="Nav1">

                        <ul class="d-flex align-items-center justify-content-between nav nav-tabs">

                        <?php if (!empty($_REQUEST['user_id'])) {?>
                            <li class="BGList"><a href="<?php echo Url::base(''); ?>#Homefeed" onclick="filterQuestion('Homefeed')" class="show">Home Feed</a></li>
                        <?php } else {?>
                            <li class="BGList"><a href="#Homefeed" onclick="filterQuestion('Homefeed')" data-toggle="tab" class="active">Home Feed</a></li>
                        <?php }?>

                        <?php if (!empty($_REQUEST['user_id'])) {?>
                            <li><a href="<?php echo Url::base(''); ?>#Unanswered" onclick="filterQuestion('Unanswered')" class="show">Unanswered</a></li>
                        <?php } else {?>
                            <li><a href="#Unanswered" onclick="filterQuestion('Unanswered')" data-toggle="tab" class="show">Unanswered</a></li>
                        <?php }?>

                         <?php if (!empty($_REQUEST['user_id'])) {?>
                            <li><a href="<?php echo Url::base(''); ?>#Answered" onclick="filterQuestion('Answered')" class="show">Answered</a></li>
                        <?php } else {?>
                            <li><a href="#Answered" onclick="filterQuestion('Answered')" data-toggle="tab" class="show">Answered</a></li>
                        <?php }?>

                        <?php if (!empty($_REQUEST['user_id'])) {?>
                            <li><a href="<?php echo Url::base(''); ?>#citizen"  onclick="AjaxCallSortCitizen()" class="show">citizen</a></li>
                        <?php } else {?>
                            <li><a href="#citizen" onclick="AjaxCallSortCitizen()"  data-toggle="tab" class="show">Citizens</a></li>
                        <?php }?>


                        </ul>
                    </nav>

                    <div class="tab-content clearfix">
                       <?php echo
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?><?php //echo Alert::widget() ?><?php echo $content ?>


                    </div>



                        <div id="citizen" class="tab-pane fade">


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
                                    <input type="text" placeholder="Search Citizen" class="SearchMp Citizen" id="search_citizen" onkeypress="AjaxCallSearchCitizen(event)"><i class="fa fa-search" onclick="AjaxCallSearchCitizenClick(event)"></i>
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
                        <input type="hidden" name="login_user_id" id="login_user_id" value="<?php echo Yii::$app->user->id ?>">
                        <ul class="d=flex align-items-center justify-content=center flex-direction-column">
                            <li><a href="<?php echo Yii::getAlias('@web') ?>/pages/community-guidelines">Community Guidelines </a></li>
                            <li><a href="<?php echo Yii::getAlias('@web') ?>/pages/annoucements">Announcements</a></li>
                            <li><a href="<?php echo Yii::getAlias('@web') ?>/pages/terms-of-use">Terms of Use</a></li>
                            <li><a href="<?php echo Yii::getAlias('@web') ?>/pages/about-bridge">About Bridge</a></li>
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
