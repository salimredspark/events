<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Speakers */

$this->title = 'Create Speakers';
$this->params['breadcrumbs'][] = ['label' => 'Speakers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speakers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
