<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Visitors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="visitors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'visitor_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'visitor_uid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
