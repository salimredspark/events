<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Speakers */

$this->title = 'Create Speakers';
$this->params['breadcrumbs'][] = ['label' => 'Speakers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speakers-create">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
