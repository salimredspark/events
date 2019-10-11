<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\User;    
    use backend\models\EventType;    
    use backend\models\EventLocation;    
    use kartik\datetime\DateTimePicker;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->event_name)?'Update':'Create';?> Event</h4>
                <p class="category">New Event will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-9">
                        <?= $form->field($model, 'event_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div> 
                     <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'username');                                                
                            echo $form->field($model, 'event_manage_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Manage By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>                                        
                </div>
                
                <div class="row">
                <div class="col-md-3">
                        <?= $form->field($model, 'event_domain_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(EventType::find()->all(), 'id', 'type_name');                                                
                            echo $form->field($model, 'event_type_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Type' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>
                                                                                
                    <div class="col-md-3">                                                                        
                    <?php                        
                            $items = ArrayHelper::map(EventLocation::find()->all(), 'id', 'location_name');                                                
                            echo $form->field($model, 'event_location_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Location' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                                                
                    </div>
                    
                </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <?php 
                            echo $form->field($model, 'start_time')->widget(
                            DateTimePicker::class, 
                            [
                            'options' => ['placeholder' => 'Event Start Date Time'],
                            'convertFormat' => false,
                            'pluginOptions' => [
                            'format' => 'd-m-yyyy hh:ii',
                            'startDate' => date("d-m-Y H:i"),
                            'todayHighlight' => true
                            ]
                            ]
                            );
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php                                                 
                            echo $form->field($model, 'end_time')->widget(
                            DateTimePicker::class, 
                            [
                            'options' => ['placeholder' => 'Event End Date Time'],
                            'convertFormat' => false,                                
                            'pluginOptions' => [
                            'format' => 'd-m-yyyy hh:ii',
                            'startDate' => date("d-m-Y h:i"),
                            'todayHighlight' => true,
                            'autoclose' => true,
                            'yearRange'=>'2019:2100'
                            ]
                            ]
                            );
                        ?>                                                
                    </div>
                                     
                                     </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'event_description', [
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