<?php
use common\components\Common;
use common\models\Questions;
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
                        <i class="fa fa-rss-square ActiveIcon OnlySm"></i>
                        <span class="badge-Box"><i class="fa fa-bell"><span class="badge badge-secondary">1</span>
                        </i>
                        </span>
                        <ul class="  Nav3">
                        <li class="d-flex align-items-center justify-content-between flex-wrap"><span>Notification</span> <span>Mark All as Unread</span></li>
                    <li><a href="">Chala Commented on your Question</a></li>
                    <li><a href="">Maya Made a Question Louder</a></li>
                      <li><a href="">Abebe Followed you</a></li>
                        <li><a href="">Lily Shared your Question</a></li>
                    </ul>
                        <i class="fa fa-search OnlySm"></i>
                        <i class="fa fa-cog"></i>
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
                    <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo">
                    <div class="MainLeftInner">
                        <div class="RemainingQuestion d-flex align-items-center justify-content=center">
                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/msg.png" ?>" alt="" class="img-fluid Msg">
                        <?php
$questions = Questions::find()->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0])->count();

$monday = Common::getLastMondaySaturday("monday");
$saturday = Common::getLastMondaySaturday("saturday");
$query = Questions::find()->where(['user_agent_id' => Yii::$app->user->id, "status" => Yii::$app->params['user_status_value']['active'], "is_delete" => 0]);
$query->andWhere(['between', 'created_at', $monday, $saturday]);
$questionCount = $query->count();
$limit = 10
?>
                        <p>Remaining Number of Questions
                            Allowed for the Week
                            <?php echo ($limit - $questionCount) ?> out of 10</p>
                            </div>
<?php if (!empty($questions)) {
    ?>
                      <div class="LastQuestion">
                        <p>Your last submitted Question</p>
                        <div class="LastQuestionBox">

                        <div class="Row1 d-flex align-items-center justify-content-between ">
                        <div class="User d-flex align-items-center justify-content center">
                        <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" class="img-fluid UserImage">
                        <div class="ProfileName">
                        <p><?php echo Common::get_user_name(Yii::$app->user->id); ?></p>
                            <?php $question = Questions::find()->where(["user_agent_id" => Yii::$app->user->id])->orderBy(["id" => SORT_DESC])->one();?>
                        <p><span><?php echo Common::time_elapsed_string($question->created_at); ?></span></p>
                        </div>
                        </div>

                        <div class="MP d-flex align-items-center justify-content center">

                        <div class="MPProfileName">
                        <p>Unanswered for</p>
<?php $mps = $question->mp_id;
    $mpArr = explode(",", $mps);

    ?>
                        <p><span><?php
$i = 0;
    foreach ($mpArr as $key => $mp) {
        echo Common::get_user_name($mp);
        $i++;
        if ($i != count($mpArr)) {
            echo ",";
        }
    }
    ?>
                       </span></p> </div>
                       <?php $userDetails = Common::get_name_by_id($mpArr[0], "Users");?>
                        <img src="<?php echo Yii::getAlias('@web') . "/uploads/" . $userDetails['photo'] ?>" alt="" class="img-fluid MPImage">
                        </div>
                        </div>

                        <div class="Row2">
                        <div class="Comments">
                            <?php $length = strlen($question->question);
    if ($length <= 120) {?>
<p> <?php echo $question->question; ?></p>
    <?php } else {?>
           <p><?php echo substr($question->question, 0, 120) ?></p>
                            <p id="dots">...</p>
                            <p id="more"><?php echo substr($question->question, 120, $length); ?></p>
                            <button onclick="myFunction()" id="myBtn">Read more</button>
    <?php }?>
    </div>


                        </div>
                            <div class="Row3">
                            <div class="Social d-flex align-items-center justify-content-between">
                            <div class="Loud" id="Load2">

                            <i class="fa fa-wifi" aria-hidden="true"></i>
                            <span>300</span>

                            </div>

                            <div class="Comment">
                            <a href="#">
                                <i class="fa fa-commenting-o" aria-hidden="true"></i>
                            <span>100</span>
                                </a>
                            </div>

                            <div class="Share">
                            <a href="#">
                            <i class="fa fa-share-alt" aria-hidden="true"></i>
                            <span>24</span>
                                </a>
                            </div>
                            </div>

                            </div>
                        </div>
                        </div>
                    <?php } else {?>
                         <div class="LongTime">
                        <p>It has been a long time
                            since you asked a Question.
                            Make your voice heard.</p>

                        </div>
                    <?php }?>




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
                    <nav class="Nav1">


                        <ul class="d-flex align-items-center justify-content-between nav nav-tabs">
                            <li class="BGList"><a href="#home" data-toggle="tab" class="active show">Home Feed</a></li>
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
                            <h1>two</h1>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h1>three</h1>
                        </div>

                        <div id="menu3" class="tab-pane fade">
                            <h1>four</h1>
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
