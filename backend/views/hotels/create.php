<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Hotels */

$this->title = 'Create Hotels';
$this->params['breadcrumbs'][] = ['label' => 'Hotels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hotels-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
