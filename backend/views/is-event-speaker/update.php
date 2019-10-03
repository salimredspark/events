<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventSpeaker */

$this->title = 'Update Is Event Speaker: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Is Event Speakers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="is-event-speaker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
