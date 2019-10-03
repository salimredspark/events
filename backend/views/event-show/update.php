<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\EventShow */

$this->title = 'Update Event Show: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="event-show-update">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
