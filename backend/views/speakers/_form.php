<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Speakers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="speakers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'speaker_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'speaker_details')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
