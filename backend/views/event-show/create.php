<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventShow */

$this->title = 'Create Event Show';
$this->params['breadcrumbs'][] = ['label' => 'Event Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-show-create">
        
    <?= $this->render('_form', [
        'model' => $model,
        'IsEventSpeaker' => $IsEventSpeaker, 
    ]) ?>

</div>
