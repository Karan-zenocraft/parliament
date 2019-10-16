<?php
use frontend\assets\ParliamentAsset;

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
    <title>BRIDGE - LOGIN</title>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo1.png" ?>" sizes="64x64">
    <meta name="theme-color" content="#000" />


</head>

<body class="example-1  scrollbar-dusty-grass square thin ForgotBody">
<?php $this->beginBody()?>
    <a href="#" id="scroll" style="display: none;z-index: 99999;">
        <span></span></a>

    <header class="NavigationBar">
        <div class="container">
            <div class="row">
                <div class="LoginBottom col-md-12 d-flex align-items-center justify-content-end">
                    <ul class="d-flex align-items-center justify-content-start flex-wrap">
                        <li><a href="">Home</a></li>
                        <li><a href="#">Login</a></li>

                    </ul>

                </div>

            </div>
        </div>
    </header>



    <section class="ForgotHeader">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-xl-5 HeaderLeft">
                    <a href="index.html"><img src="../image/Logo1.png" alt="" class="img-fluid Logo"></a>




                </div>
                <div class="col-md-12 col-xl-7 HeaderRight ForgotRight">
                     <?php echo
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?><?php //echo Alert::widget() ?><?php echo $content ?>
                </div>

            </div>
        </div>

    </section>
      <?php $this->endBody();?>
      <?php $this->endPage()?>
</body>

</html>
