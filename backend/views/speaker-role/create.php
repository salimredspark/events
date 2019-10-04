<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SpeakerRole */

$this->title = 'Create Speaker Role';
$this->params['breadcrumbs'][] = ['label' => 'Speaker Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="speaker-role-create">        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
