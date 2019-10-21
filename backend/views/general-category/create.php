<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\GeneralCategory */

$this->title = 'Create General Category';
$this->params['breadcrumbs'][] = ['label' => 'General Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="general-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
