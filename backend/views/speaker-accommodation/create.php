<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpeakerAccommodation */

$this->title = 'Create Speaker Accommodation';
$this->params['breadcrumbs'][] = ['label' => 'Speaker Accommodations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speaker-accommodation-create">

    <?= $this->render('_form', [
        'model' => $model,
        'speaker_id' => $model->speaker_id,
            'event_id' => $model->event_id,
            'modelEvent' => $modelEvent,
            'modelSpeaker' => $modelSpeaker,
            'modelCategory' => $modelCategory,
    ]) ?>

</div>
