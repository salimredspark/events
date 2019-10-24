<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationBooth */

$this->title = 'Create Event Location Booth';
$this->params['breadcrumbs'][] = ['label' => 'Event Location Booths', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-location-booth-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
