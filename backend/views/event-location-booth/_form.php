<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\EventLocationBooth */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-location-booth-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'event_location_id')->textInput() ?>

    <?= $form->field($model, 'booth_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'booth_detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
