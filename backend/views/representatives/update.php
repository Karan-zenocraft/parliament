<?php

/* @var $this yii\web\View */
/* @var $model common\models\Representatives */

$this->title = 'Update Representative: ' . ' ' . $model->user_name;
$this->params['breadcrumbs'][] = ['label' => 'Manage Representatives', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="representatives-update email-format-create">

    <?=$this->render('_form', [
    'model' => $model,
])?>

</div>
