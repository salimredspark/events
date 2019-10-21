<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralVendor */

$this->title = 'Create General Vendor';
$this->params['breadcrumbs'][] = ['label' => 'General Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-vendor-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
