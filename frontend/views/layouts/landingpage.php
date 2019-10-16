<?php

///* @var $this \yii\web\View */
/* @var $content string */
use common\models\Representatives;
use frontend\assets\ParliamentAsset;
use yii\widgets\Breadcrumbs;
/* @var $content string */
$this->registerCssFile('@web/themes/parliament_theme/css/style.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/themes/parliament_theme/css/responsive.css', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerCssFile('@web/themes/parliament_theme/css/inner-responsive.css', ['depends' => [yii\web\JqueryAsset::className()]]);
ParliamentAsset::register($this);
//CommonAppAsset::register( $this );
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>

<head>
    <title>BRIDGE - LOGIN</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo1.png" ?>" type="image/png" sizes="64x64">
    <meta name="theme-color" content="#000"/>

<?php $this->head();?>
</head>

<body class="example-1  scrollbar-dusty-grass square thin">
  <?php $this->beginBody()?>
    <a href="#" id="scroll" style="display: none;z-index: 99999;">
        <span></span></a>


    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xl-5 HeaderLeft">
                    <a href="#"><img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo1.png" ?>" alt="" class="img-fluid Logo"></a>




                </div>
                <div class="col-md-12 col-xl-7 HeaderRight">
                    <h1>Ask YOUR representatives direct questions</h1>
<?php
$representativesArr = Representatives::find()->asArray()->all();
?>
                    <div class="Representative  d-flex align-items-start justify-content-start">
                        <div class="row">
                      <?php if (!empty($representativesArr)) {
    $i = 1;
    foreach ($representativesArr as $key => $user) {
        ?>

                            <div class="Profile">
                                <img src="<?php echo Yii::getAlias('@web') . "/uploads/" . $user['photo'] ?>" alt="" class="img-fluid">
                                <div class="ProfileTitle">
                                    <p><?php echo $user['user_name']; ?></p>
                                    <p><span><?php echo $user['standing_commitee']; ?></span></p>
                                </div>
                            </div>

    <?php
if ($i == 2) {
            echo "</div><div class='row'>";
        }
        $i++;}}?>


                       <!--      <div class="Profile d-flex flex-wrap align-items-center justify-content-start">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/3.png" ?>" alt="" class="img-fluid">
                                <div class="ProfileTitle">
                                    <p> Bitew Tasew</p>
                                    <p><span>Agriculture & Pastoralism <br> Standing Committee</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="Profile d-flex flex-wrap align-items-center justify-content-start">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/2.png" ?>" alt="" class="img-fluid">
                                <div class="ProfileTitle">
                                    <p>Cally Feeney</p>
                                    <p><span>Foreign Relations & Peace <br> Standing Committee</span></p>
                                </div>
                            </div>


                            <div class="Profile d-flex flex-wrap align-items-center justify-content-start">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/4.png" ?>" alt="" class="img-fluid">
                                <div class="ProfileTitle">
                                    <p>Hailu Kassa</p>
                                    <p><span>Foreign Relations & Peace <br> Standing Committee</span></p>
                                </div>
                            </div>
                        </div> -->
                    </div>



                </div>
 <h2>Get invlolved</h2>
            </div>
        </div>

    </header>
    <section class="Login">
<?php echo
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?><?php //echo Alert::widget() ?><?php echo $content ?>

    </section>
 <?php $this->endBody();?>
<?php $this->endPage()?>
</body>

</html>
