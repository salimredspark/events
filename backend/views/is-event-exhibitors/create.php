<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventExhibitors */

$this->title = 'Create Is Event Exhibitors';
$this->params['breadcrumbs'][] = ['label' => 'Is Event Exhibitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="is-event-exhibitors-create">
        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
