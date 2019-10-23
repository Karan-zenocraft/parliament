<?php

use common\components\Common;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\AnswersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Comments';
$this->params['breadcrumbs'][] = ['label' => 'Manage Questions', 'url' => ['questions/index']];
$this->params['breadcrumbs'][] = ['label' => 'Manage Comments', 'url' => ['comments/index', 'qid' => $_GET['qid']]];
$this->params['breadcrumbs'][] = ['label' => 'Question'];
?>
<div class="comments-index email-format-index">
<div class="email-format-index">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left">Search Here</div>
    </div>
        <div class="block-content collapse in">
        <div class="users-form span12">

     <?=Html::a(Yii::t('app', '<i class="icon-filter icon-white"></i> Filter'), "javascript:void(0);", ['class' => 'btn btn-primary open_search']);?>
     <?php if (!empty($_REQUEST['CommentsSearch']) || (!empty($_GET['temp']) && $_GET['temp'] == "clear")) {?>
        <div class="commentss-search common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
<?php } else {?>
    <div class="comments-search common_search">
         <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    <?php }?>
</div>
</div>
</div>
<div class="navbar navbar-inner block-header">
        <div class="muted pull-left">
            <?php echo Html::encode($this->title) . ' - ' . $snQuestion ?>
        </div>
       <!--  <div class="pull-right">
            <?php //Html::a(Yii::t('app', '<i class="icon-plus"></i> Add Layout'), Yii::$app->urlManager->createUrl(['restaurant-layout/create', 'rid' => ( $_GET['rid'] > 0 ) ? $_GET['rid'] : 0]), ['class' => 'btn btn-success colorbox_popup','onclick' => 'javascript:openColorBox(420,400);']) ?>
        </div> -->
    </div>
    <div class="block-content">
    <?php Pjax::begin();?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'layout' => "<div class='table-scrollable'>{items}</div>\n<div class='margin-top-10'>{summary}</div>\n<div class='dataTables_paginate paging_bootstrap pagination'>{pager}</div>",
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        //'id',
        //'question_id',
        'comment_text',
        [
            'attribute' => 'user_agent_id',
            //  'filterOptions' => ["style" => "width:13%;"],
            /*  'value' => function ($data) {
            return $data->restaurant->name;
            },*/
            'format' => 'raw',
            'value' => function ($data) {
                $ssText = !empty($data->user_agent_id) ? Common::get_user_name($data->user_agent_id) : "-";
                //   $url = Yii::$app->urlManager->createUrl(['reservations/view', 'id' => $data->id]);
                return $ssText;
            },
        ],
        //'status',
        //'is_delete',
        //'created_at',
        //'updated_at',

        // ['class' => 'yii\grid\ActionColumn'],
    ],
]);?>
   </div>
</div>
</div>
<script type="text/javascript">
$( document ).ready(function() {
    $('.comments-search').hide();
        $('.open_search').click(function(){
            $('.comments-search').toggle();
        });
    });

</script>
