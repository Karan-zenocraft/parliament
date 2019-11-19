<?php
use common\components\Common;

$answered_mp_arr = array_unique($answered_mp);
$count_answer = count(array_unique($answered_mp));
?>
              <div class="UnansweredBy d-flex flex-wrap align-items-center">
          <a href="#"><span class="Title">Answered by</span></a>
    <?php $first_mp_answered_id = current($answered_mp);?>
          <?php if ($count_answer == 1) {
    ?>
          <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_answered_id; ?>"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id);
    ?></span></a>
<?php $first_ansmp_name = Common::get_name_by_id($first_mp_answered_id, "Users");
    $first_ansmp_image = !empty($first_ansmp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_ansmp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
    <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_ansmp_name['photo']) ? $first_ansmp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
          <?php } else {
    ?>
            <a href="<?php echo Yii::getAlias('@web') . "?user_id=" . $first_mp_answered_id; ?>"><span class="MP"><?php echo Common::get_user_name($first_mp_answered_id) . " ";
    ?>and</span></a>
              <a><span class="MPName OnhoverGroup" onmouseover="show_mp_list('<?php echo $question[0]['id'] ?>');" id="<?php echo $question[0]['id'] ?>"> <?php echo " " . ($count_answer - 1); ?> others</span></a>
              <?php $first_ansmp_name = Common::get_name_by_id($first_mp_answered_id, "Users");
    $first_ansmp_image = !empty($first_ansmp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $first_ansmp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"?>
    <a href="javascript:void(0);" class="UsersImg"><img class="One img-fluid rounded-circle" src="<?php echo !empty($first_ansmp_name['photo']) ? $first_ansmp_image : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png" ?>" alt="" width="24px" height="24px">
            <?php }
?>

<?php $exclude_first_answer = array_shift($answered_mp);
//p(array_unique($answered_mp), 0);
?>
            <div class="Absolute">
            <?php $i = 1;
foreach ($answered_mp as $key => $ans_mp) {
    $ans_mp_name = Common::get_name_by_id($ans_mp, "Users");
    //$ans_mp_image = $ans_mp_name['photo'];
    $ans_mp_image = !empty($ans_mp_name['photo']) ? Yii::getAlias('@web') . "/uploads/" . $ans_mp_name['photo'] : Yii::getAlias('@web') . "/themes/parliament_theme/image/user.png;"
    ?>
            <img class="Img<?php echo $i; ?>" src="<?php echo $ans_mp_image; ?>" alt="" class="img-fluid rounded-circle" width="24px" height="24px">
            <?php $i++;
}?>
            </div>
          </a>
          <ul class="align-items-start justify-content-start flex-column OnhoverMP" id="OnhoverMP<?php echo $question[0]['id']; ?>">
          <?php
foreach (array_unique($answered_mp) as $key => $answered_mp) {
    echo "<li><a href=" . Yii::getAlias('@web') . "?user_id=" . $answered_mp . ">" . Common::get_user_name($answered_mp) . "</a></li>";
}
?>
  </ul>
        </div>