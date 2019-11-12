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
<style>
footer{background: #10313E;padding: 40px 0;}
    footer a:hover{transition: 0.4s all;color: #fff;}
footer a {margin-top: 10px;font-size: 14px;line-height: 18px;color: #fff;font-family: 'Segoe UI';font-weight: normal;outline: none;text-transform: uppercase;letter-spacing: 1px;}
.Main .MainCenter{min-height: 410px;border: 0px solid #707070;padding-bottom: 0px!important;padding-top: 0px!important;display: flex;align-items: center;justify-content: center;}
body{background-image: linear-gradient(#10313E, #020000);}
    .Main .MainCenter p{font-size: 16px;margin-bottom: 15px;line-height: 22px;color: #000;font-family: 'Segoe UI';}
</style>


<head>
    <title><?php echo !empty($this->params['page_title']) ? $this->params['page_title'] : "B4Pet" ?></title>
    <meta charset="UTF-8">
    <meta name="description" content="<?php echo !empty($this->params['meta_description']) ? $this->params['meta_description'] : "" ?>">
    <meta name="keywords" content="<?php echo !empty($this->params['meta_keyword']) ? $this->params['meta_keyword'] : "" ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Logo1.png" ?>" type="image/png" sizes="64x64">
    <meta name="theme-color" content="#000" />
</head>
<body class="example-1  scrollbar-dusty-grass square thin" >
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

                </div>
            </div>

        </div>
    </header>
    <section class="Main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 cus-md-3 MainLeft">
                   <a style="" href="<?php echo Yii::getAlias('@web') ?>"> <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Inner-Logo.png" ?>" alt="" class="img-fluid Inner-Logo"></a>
                </div>
                <div class="col-md-12 col-lg-6 cus-md-6 MainCenter" style="padding-bottom: 300px;background: #E4E4E4">


                    <div class="tab-content clearfix">
<?php echo
Breadcrumbs::widget([
    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
])
?><?php echo $content ?>
                    </div>
                </div>
                <div class="col-md-3 cus-md-3 MainRight">

                </div>
            </div>
        </div>
    </section>

<footer>
<div class="container-fluid">
<div class="row">
<div class="col-md-12 d-flex align-items-center justify-content-center">
<a href="#">All rights reserved © BRIDGE for Participation 2019</a>
    
</div>    
    
</div>    
    
</div>    
    
    
</footer>


    <?php $this->endBody();?>
      <?php $this->endPage()?>
</body>

</html>
