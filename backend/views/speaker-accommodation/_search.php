<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SpeakerAccommodationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="speaker-accommodation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'speaker_id') ?>

    <?= $form->field($model, 'event_id') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'vendor_id') ?>

    <?php // echo $form->field($model, 'category_item') ?>

    <?php // echo $form->field($model, 'category_item_qty') ?>

    <?php // echo $form->field($model, 'manage_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
