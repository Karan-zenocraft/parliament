<?php

/* @var $this yii\web\View */
/* @var $model common\models\Users */

$this->title = 'Update Users: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="users-update email-format-create">

    <?=$this->render('_form', [
    'model' => $model,
    'UserRolesDropdown' => $UserRolesDropdown,

])?>

</div>
