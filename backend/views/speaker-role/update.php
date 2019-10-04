<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpeakerRole */

$this->title = 'Update Speaker Role: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Speaker Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="speaker-role-update">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
