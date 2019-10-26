<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\QuestionReported */

$this->title = 'Create Question Reported';
$this->params['breadcrumbs'][] = ['label' => 'Question Reporteds', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="question-reported-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
