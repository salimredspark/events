<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotels */

$this->title = 'Update Hotels: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="hotels-update">
            <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
