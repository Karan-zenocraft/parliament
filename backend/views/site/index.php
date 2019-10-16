<?php
use common\models\Answers;
use common\models\Comments;
use common\models\Questions;
use common\models\Users;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Statistics';
$this->params['breadcrumbs'][] = $this->title;
//$this->params['page']['title'] = "Dashboard";
?>
<div class="site-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
    </div>
    <div class="block-content collapse in">
        <div class="span3">
            <div class="chart" data-percent="<?=Users::find()->count();?>"><?=Users::find()->count() . "%";?></div>
            <div class="chart-bottom-heading">
                <span class="label label-info">Users</span>
            </div>
        </div>
        <div class="span3">
            <div class="chart" data-percent="<?=Questions::find()->count();?>"><?=Questions::find()->count() . "%";?></div>
            <div class="chart-bottom-heading">
                <span class="label label-info">Questions</span>
            </div>
        </div>
        <div class="span3">
            <div class="chart" data-percent="<?=Answers::find()->count();?>"><?=Answers::find()->count() . "%";?></div>
            <div class="chart-bottom-heading">
                <span class="label label-info">Answers</span>
            </div>
        </div>
        <div class="span3">
            <div class="chart" data-percent="<?=Comments::find()->count();?>"><?=Comments::find()->count() . "%";?></div>
            <div class="chart-bottom-heading">
                <span class="label label-info">Comments</span>
            </div>
        </div>
    </div>
</div>
<script>
$(function() {
    // Easy pie charts
    $('.chart').easyPieChart({animate: 1000});
});
</script>