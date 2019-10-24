<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
    use yii\helpers\ArrayHelper;
    use backend\models\User; 
    use backend\models\Events;  
    use backend\models\Exhibitors; 
    use backend\models\EventLocation; 
    use backend\models\EventLocationSlots; 
    use backend\models\EventLocationBooth;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Assign';?> Exhibitor to Event</h4>
                <p class="category">Exhibitor will be assign to event</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">                    
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(EventLocation::find()->all(), 'id', 'location_name');                                                
                            echo $form->field($model, 'event_location_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Hall' ]
                            ])->dropDownList( $items, ['prompt'=>'',]);
                        ?>
                    </div>
                    <div class="col-md-6">                        
                        <?= $form->field($model, 'booth_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    
                    </div>                    

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'booth_detail', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])?>
                    </div>                     
                </div>                

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

 