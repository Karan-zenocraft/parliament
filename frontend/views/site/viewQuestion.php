<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Questions */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Questions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="questions-view">
    <?=DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'user_agent_id',
        'question',
        'mp_id',
        'status',
        'is_delete',
        'created_at',
        'updated_at',
    ],
])?>

</div>
