<?php

use common\components\Common;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\PagesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Manage Pages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pages-index">

    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><?php echo Html::encode($this->title) ?></div>
        <div class="pull-right">
            <?php echo Html::a(Yii::t('app', '<i class="icon-plus"></i> Add Page'), ['create'], ['class' => 'btn btn-success']) ?>
            <?php echo Html::a(Yii::t('app', '<i class="icon-refresh"></i> Reset'), Yii::$app->urlManager->createUrl(['pages/index']), ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <div class="block-content">
    <?php echo GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => null,
    'layout' => "<div class='table-scrollable'>{items}</div>\n<div class='col-md-5 col-sm-12'><div class='row'>{summary}</div></div>\n<div class='col-md-7 col-sm-12'><div class='row'>{pager}</div></div>", 'layout' => "<div class='table-scrollable'>{items}</div>\n<div class='col-md-5 col-sm-12'><div class='row'>{summary}</div></div>\n<div class='col-md-7 col-sm-12'><div class='row'>{pager}</div></div>",
    'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

        // 'id',
        // 'custom_url:url',
        'page_title',
        [
            'attribute' => 'status',
            'filter' => Yii::$app->params['user_status'],
            'filterOptions' => ["style" => "width:10%;"],
            'headerOptions' => ["style" => "width:10%;"],
            'contentOptions' => ["style" => "width:10%;"],
            'value' => function ($model) {
                return !empty($model->status) ? Yii::$app->params['user_status'][$model->status] : Yii::$app->params['user_status'][$model->status];
            },

        ],
        // 'page_content:ntext',
        // 'meta_title',
        // 'meta_keyword',
        // 'meta_description:ntext',
        // 'status',
        // 'created_at',
        // 'updated_at',

        [
            'header' => 'Actions',
            'class' => 'yii\grid\ActionColumn',
            'headerOptions' => ["style" => "width:20%;"],
            'template' => '{update}{delete}',

            'buttons' => [
                'update' => function ($url, $model) {

                    $url = Yii::$app->urlManager->createUrl(['pages/update', 'id' => $model->id]);
                    return Common::template_update_button($url, $model);
                },
                'delete' => function ($url, $model) {
                    $message = 'Are you sure you want to delete this Page ?';
                    return Common::template_delete_button($url, $model, $message);
                },
            ],
        ],
    ],
]); ?>
    </div>
</div>

