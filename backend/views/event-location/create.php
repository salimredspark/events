<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocation */

$this->title = 'Create Event Location';
$this->params['breadcrumbs'][] = ['label' => 'Event Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-location-create">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
