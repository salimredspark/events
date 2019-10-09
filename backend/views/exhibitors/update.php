<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitors */

$this->title = 'Update Exhibitors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Exhibitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="exhibitors-update">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
