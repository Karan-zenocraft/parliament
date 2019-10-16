<?php

/* @var $this yii\web\View */
/* @var $model common\models\Representatives */

$this->title = 'Create Representative';
$this->params['breadcrumbs'][] = ['label' => 'Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="email-format-create representatives-create">
    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
