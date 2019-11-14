
<div class="CitizenPage">
                            <div class="Row1 d-flex align-items-center justify-content-start p-0">
                                <?php if (!empty($models)) {
    $numOfCols = 3;
    $rowCount = 1;
    foreach ($models as $key => $value) {
        ?>
                            <div class="ProfileBlock col-md-4 p-0">
                            <div class="Block1 d-flex align-items-center justify-content-center">
                            <div class="BlockImg">
                                <?php $user_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/people.png"?>
                                <img src="<?php echo $user_image; ?>" alt="" class="rounded-circle">


                            </div>
                            <div class="BlockCaption">
                                <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $value['id']; ?>"><h2><?php echo $value['name']; ?></h2></a>
                                <p><?php echo $value['city']; ?></p>
                                <p><?php echo $value['education']; ?></p>
                                <!-- <a class="Follow Followed"><span>Follow</span><span>300</span> </a> -->
                            </div>
                            </div>
                            </div>
                                   <?php if (($rowCount % $numOfCols == 0) && ($rowCount != $pagination->pageSize)) {
            echo '</div><div class="Row1 d-flex align-items-center justify-content-start p-0">';
        }
        $rowCount++;
    }} else {
    echo "<span style='color:#9DAAB0'>No more record found</span>";
}?>


                            <div class="SliderArrowCitizen">
                            <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="rounded-circle arrows arrows-right"  onclick="getPageCitizen('next')">


                               <img src="<?php echo Yii::getAlias('@web') . "/themes/parliament_theme/image/slider-arrow.png" ?>" alt="" class="rounded-circle arrows arrows-left" onclick="getPageCitizen('prev')">


                            </div>
                            </div>