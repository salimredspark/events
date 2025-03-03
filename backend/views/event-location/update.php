<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocation */

$this->title = 'Update Event Location: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-location-update">

        <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
