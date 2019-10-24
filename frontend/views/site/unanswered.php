<meta property="og:url" content="http://ask.zenocraft.com" />
<meta property="og:type" content="website" />
<meta property="og:title"  content=" Notice of Passing" />
<meta property="og:description"   content="Notice of Passing " />
<meta property="og:image" content="http://ask.zenocraft.com/uploads/IMG-20180804-WA0001_5dab09cb6270f.jpg" />
<?php
// use kartik\icons\FontAwesomeAsset;
// FontAwesomeAsset::register($this);
?>
<div id="home" class="tab-pane active show Flex">
<div class="FilterBar SearchAnswredBar  align-items-end justify-content-between">
<nav class="Nav2 Nav5 ">
  <ul class="d-flex align-items-center justify-content-start nav">
    <li class="FilterActive"><a onclick="filterQuestion2('recent')">Recent </a><i class="fa fa-clock-o" aria-hidden="true"></i></li>
    <li><a onclick="filterQuestion2('loudest')">Loudest </a><i class="fa fa-bullhorn" aria-hidden="true"></i></li>
  </ul>
</nav>
<!--    <div class="SearchMps SearchAnswredMps">
  <input type="search" placeholder="Search UnAnswered Questions" class="SearchMp AnswredQ"><i class="fa fa-search"></i>
</div> -->
</div>
<div class="QuestionAnswer">
<!-- QUESTIONS AND ANSWER SECTION START-->
<div class="QuestionAnswerTitle Public">
  <h3>PUBLIC Questions</h3>
</div>
<input type='hidden' id='pageQuestion' value='0'>
<?php if (!empty($_REQUEST['user_id'])) {?>
<input type='hidden' id='filterQuestion' value='profile'>
  <?php } else {?>
<input type='hidden' id='filterQuestion' value=''>
  <?php }?>
<input type='hidden' id='filterQuestion2' value=''>
<input type='hidden' id='sort' value='asc'>
<input type='hidden' id='sortby' value=''>
<input type='hidden' id='page' value='1'>
<input type='hidden' id='user_id' value="<?php echo !empty($_REQUEST['user_id']) ? $_REQUEST['user_id'] : Yii::$app->user->id ?>">
<div id='ajaxQuestion'>
</div>
<br><center><button class="load_more" id="loadmoreData" onclick="QuestionAnswer()" >Load More</button></center>
    <!---------new-content-end----------------->
  </div>