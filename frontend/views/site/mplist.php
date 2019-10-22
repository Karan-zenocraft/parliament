<div class="Row1 col-md-12 d-flex align-items-center justify-content-start">
           <?php if (!empty($models)) {
    $numOfCols = 3;
    $rowCount = 1;
    foreach ($models as $key => $value) {
        ?>
        <?php $mp_image = !empty($value['photo']) ? Yii::getAlias('@web') . "/uploads/" . $value['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/slide1.png";?>
        <div class="RowBox d-flex align-items-center justify-content-start col-md-4 p-0">
          <div class="DimmerBox" id="<?php echo "mp_" . $value['id'] ?>"><img src="<?php echo $mp_image ?>" alt="" class="img-fluid rounded-corner SliderImage"></div>
            <a href="#"><div class="RowTitle">
            <p><?php echo $value['user_name']; ?></p>
            <p><span><?php echo $value['standing_commitee']; ?><br>
                Standing Committee</span></p>
                </div>
                </a>
          </div>
      <?php if (($rowCount % $numOfCols == 0) && ($rowCount != $pagination->pageSize)) {
            echo '</div><div class="Row1 col-md-12 d-flex align-items-center justify-content-start">';
        }
        $rowCount++;
    }}?>
</div>