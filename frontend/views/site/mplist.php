<div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
           <?php if (!empty($models)) {
    $numOfCols = 3;
    $rowCount = 1;
    foreach ($models as $key => $value) {
        ?>
         <div class="RowBox d-flex align-items-center justify-content-start col-md-4 p-0">
                    <?php $mp_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png";?>
                    <div class="DimmerBox" id="<?php echo "mp_" . $value['id'] ?>"><img src="<?php echo $mp_image; ?>" alt="" class="rounded-circle SliderImage"></div>
                   <div class="RowTitle">
                      <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $value['id']; ?>"> <p><?php echo $value['user_name']; ?></p>
                  </a>
                      <p><span><?php echo $value['standing_commitee']; ?><br>
                      Standing Committee</span></p>
                    </div>
                </div>
      <?php if (($rowCount % $numOfCols == 0) && ($rowCount != $pagination->pageSize)) {
            echo '</div><div class="Row1 col-md-12 d-flex align-items-center justify-content-start">';
        }
        $rowCount++;
    }}?>
</div>