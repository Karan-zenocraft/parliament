
<div class="CitizenPage">
                            <div class="Row1 d-flex align-items-center justify-content-start p-0">
                                <?php if (!empty($models)) {
    $numOfCols = 3;
    $rowCount = 1;
    foreach ($models as $key => $value) {
        ?>
                            <div class="ProfileBlock">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/Citizen1.png" ?>" alt="" class="rounded-circle">


                            </div>
                            <div class="BlockCaption">
                                <h2><?php echo $value['user_name']; ?></h2>
                                <p><?php echo $value['city']; ?></p>
                                <p><?php echo $value['education']; ?></p>
                                <a class="Follow Followed"><span>Follow</span><span>300</span> </a>
                            </div>
                            </div>
                            </div>
                                   <?php if (($rowCount % $numOfCols == 0) && ($rowCount != $pagination->pageSize)) {
            echo '</div><div class="Row1 d-flex align-items-center justify-content-start p-0">';
        }
        $rowCount++;
    }}?>


                            <div class="SliderArrowCitizen">
                            <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="img-fluid arrows arrows-right"  onclick="getPageCitizen('next')">


                               <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="img-fluid arrows arrows-left" onclick="getPageCitizen('prev')">


                            </div>
                            </div>