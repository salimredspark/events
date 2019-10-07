<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationSlots */

$this->title = 'Update Event Location Slots: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Location Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-location-slots-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
