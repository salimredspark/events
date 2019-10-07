<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'location_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_details')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
