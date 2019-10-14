<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventExhibitors */

$this->title = 'Update Is Event Exhibitors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Is Event Exhibitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="is-event-exhibitors-update">
        
    <?= $this->render('_form', [
        'model' => $model,
        'userModel' => $userModel,
    ]) ?>

</div>
