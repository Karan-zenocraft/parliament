<?php

use common\components\Common;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionReportedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question Reported';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-reported-index email-format-index">
<div class="email-format-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Search Here</div>
    </div>
        <div class="block-content collapse in">
        <div class="question-reported-form span12">

     <?=Html::a(Yii::t('app', '<i class="icon-filter icon-white"></i> Filter'), "javascript:void(0);", ['class' => 'btn btn-primary open_search']);?>
     <?php if (!empty($_REQUEST['QuestionsSearch']) || (!empty($_GET['temp']) && $_GET['temp'] == "clear")) {?>
        <div class="question-reporteds-serach common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
<?php } else {?>
    <div class="question-reported-serach common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    <?php }?>
</div>
</div>
</div>
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
        <div class="pull-right">
            <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> Reset'), Yii::$app->urlManager->createUrl(['question-reported/index']), ['class' => 'btn btn-primary'])?>
        </div>
    </div>
      <div class="block-content">
        <div class="goodtable">
    <?php// Pjax::begin();?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "<div class='table-scrollable'>{items}</div>\n<div class='margin-top-10'>{summary}</div>\n<div class='dataTables_paginate paging_bootstrap pagination'>{pager}</div>",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //  'id',
        [
            'attribute' => 'question_id',
            //  'filterOptions' => ["style" => "width:13%;"],
            /*  'value' => function ($data) {
            return $data->restaurant->name;
            },*/
            'format' => 'raw',
            'value' => function ($data) {
                $ssText = !empty($data->question) ? $data->question->question : "";
                //   $url = Yii::$app->urlManager->createUrl(['reservations/view', 'id' => $data->id]);
                return $ssText;
            },
        ],

        [
            'attribute' => 'user_id',
            //  'filterOptions' => ["style" => "width:13%;"],
            /*  'value' => function ($data) {
            return $data->restaurant->name;
            },*/
            'format' => 'raw',
            'value' => function ($data) {
                $ssText = !empty($data->user) ? $data->user->user_name : "";
                //   $url = Yii::$app->urlManager->createUrl(['reservations/view', 'id' => $data->id]);
                return $ssText;
            },
        ],
        'report_comment:ntext',
        //  'created_at',
        //'updated_at',

        [
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' => ["style" => "width:40%;"],
            'contentOptions' => ["style" => "width:40%;"],
            'template' => '{delete}',
            'buttons' => [
                'delete' => function ($url, $model) {
                    $flag = 1;
                    //  $url = Yii::$app->urlManager->createurl(['question-reported/delete', 'id' => $model->id, 'qid' => $model->question_id]);
                    $confirmmessage = "Are you sure you want to delete this question?";
                    return Common::template_delete_button($url, $model, $confirmmessage, $flag);
                },

            ],
        ],
    ],
]);?>

    <?php// Pjax::end();?>

</div>
</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    $('.question-reported-serach').hide();
        $('.open_search').click(function(){
            $('.question-reported-serach').toggle();
        });
    });

</script>