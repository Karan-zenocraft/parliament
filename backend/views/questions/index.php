<?php

use common\components\Common;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\QuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Questions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="questions-index email-format-index">
<div class="email-format-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Search Here</div>
    </div>
        <div class="block-content collapse in">
        <div class="questions-form span12">

     <?=Html::a(Yii::t('app', '<i class="icon-filter icon-white"></i> Filter'), "javascript:void(0);", ['class' => 'btn btn-primary open_search']);?>
     <?php if (!empty($_REQUEST['QuestionsSearch']) || (!empty($_GET['temp']) && $_GET['temp'] == "clear")) {?>
        <div class="questionss-serach common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
<?php } else {?>
    <div class="questions-serach common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    <?php }?>
</div>
</div>
</div>
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?=Html::encode($this->title)?></div>
        <div class="pull-right">
            <?=Html::a(Yii::t('app', '<i class="icon-refresh"></i> Reset'), Yii::$app->urlManager->createUrl(['questions/index']), ['class' => 'btn btn-primary'])?>
        </div>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]);  ?>
    <div class="block-content">
        <div class="goodtable">
    <?php //Pjax::begin();?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'layout' => "<div class='table-scrollable'>{items}</div>\n<div class='margin-top-10'>{summary}</div>\n<div class='dataTables_paginate paging_bootstrap pagination'>{pager}</div>",
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //  'id',

        [
            'attribute' => 'user_agent_id',
            //  'filterOptions' => ["style" => "width:13%;"],
            /*  'value' => function ($data) {
            return $data->restaurant->name;
            },*/
            'format' => 'raw',
            'value' => function ($data) {
                $ssText = !empty($data->userAgent) ? $data->userAgent->user_name : "";
                //   $url = Yii::$app->urlManager->createUrl(['reservations/view', 'id' => $data->id]);
                return $ssText;
            },
        ],
        'question',
        [
            'attribute' => 'mp_id',
            //  'filterOptions' => ["style" => "width:13%;"],
            /*  'value' => function ($data) {
            return $data->restaurant->name;
            },*/
            'format' => 'raw',
            'value' => function ($data) {
                $ssText = !empty($data->mp_id) ? Common::getMpNames($data->mp_id) : "-";
                //   $url = Yii::$app->urlManager->createUrl(['reservations/view', 'id' => $data->id]);
                return Common::getMpNames($data->mp_id);
            },
        ],
        // 'louder_by:ntext',
        //'status',
        //'is_delete',
        //'created_at',
        //'updated_at',

        [
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}{manage_answers}{manage_comments}',
            'buttons' => [
                /* 'update' => function ($url, $model) {
                $flag = 1;
                return Common::template_update_button($url, $model, $flag);
                },*/
                'delete' => function ($url, $model) {
                    $flag = 1;
                    $confirmmessage = "Are you sure you want to delete this question?";
                    return Common::template_delete_button($url, $model, $confirmmessage, $flag);
                },
                'manage_answers' => function ($url, $model) {
                    $title = "View Answers";
                    $flag = 1;
                    $url = Yii::$app->urlManager->createUrl(['answers/index', 'qid' => $model->id]);
                    return Common::template_view_answers_button($url, $model, $title, $flag);
                },
                'manage_comments' => function ($url, $model) {
                    $title = "View Comments";
                    $flag = 2;
                    $url = Yii::$app->urlManager->createUrl(['comments/index', 'qid' => $model->id]);
                    return Common::template_view_answers_button($url, $model, $title, $flag);
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
    $('.questions-serach').hide();
        $('.open_search').click(function(){
            $('.questions-serach').toggle();
        });
    });

</script>