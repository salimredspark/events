<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Speakers */

$this->title = 'Update Speakers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Speakers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="speakers-update">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
