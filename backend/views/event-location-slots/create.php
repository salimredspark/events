<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationSlots */

$this->title = 'Create Event Location Slots';
$this->params['breadcrumbs'][] = ['label' => 'Event Location Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-location-slots-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
