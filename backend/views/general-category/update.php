<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralCategory */

$this->title = 'Update General Category: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'General Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="general-category-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
