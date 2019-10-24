<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationBooth */

$this->title = 'Update Event Location Booth: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Location Booths', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-location-booth-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
