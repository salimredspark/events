<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationSlots */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-location-slots-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_location_id')->textInput() ?>

    <?= $form->field($model, 'slot_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slot_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'slot_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
