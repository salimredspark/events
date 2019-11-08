<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\EventType;
    use kartik\datetime\DateTimePicker;
    use kartik\color\ColorInput;

/* @var $this yii\web\View */
/* @var $model backend\models\EventType */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Topic Type</h4>
                <p class="category">New Event Topic Type will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
               
                <div class="row">                        
                    <div class="col-md-6">
                        <?= $form->field($model, 'type_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    
                     <div class="col-md-6">
                        <?php
                         
                        
                        echo $form->field($model, 'color', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->widget(ColorInput::classname(), [
                        'options' => ['placeholder' => 'Select Color'],
                        'class'=>'form-control'
                        ]);

                        ?>
                    </div>
                </div>
                              

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div> 