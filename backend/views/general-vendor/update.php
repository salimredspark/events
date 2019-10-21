<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralVendor */

$this->title = 'Update General Vendor: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'General Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="general-vendor-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
