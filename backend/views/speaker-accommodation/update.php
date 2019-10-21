<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpeakerAccommodation */

$this->title = 'Update Speaker Accommodation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Speaker Accommodations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="speaker-accommodation-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
