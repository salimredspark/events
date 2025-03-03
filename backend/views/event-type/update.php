<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventType */

$this->title = 'Update Event Type: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-type-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
