<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Exhibitors */

$this->title = 'Create Exhibitors';
$this->params['breadcrumbs'][] = ['label' => 'Exhibitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="exhibitors-create">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
