<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventSpeaker */

$this->title = 'Create Is Event Speaker';
$this->params['breadcrumbs'][] = ['label' => 'Is Event Speakers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="is-event-speaker-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
