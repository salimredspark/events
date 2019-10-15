<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\Events;
    use backend\models\EventType;    
    use backend\models\Speakers;
    use backend\models\SpeakerRole;
    use backend\models\Hotels; 
    use backend\models\User;
    use backend\models\EventLocation;
    use backend\models\EventLocationSlots;
    use kartik\datetime\DateTimePicker;    
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Event Topic</h4>
                <p class="category">New Event Topic will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');                                                
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Event' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>                       
                    <div class="col-md-6">
                        <?= $form->field($model, 'show_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=>'Topic Title' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                    <?php                        
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'username');                                                
                            echo $form->field($model, 'show_manage_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Topic Manage By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                </div> 

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                            echo $form->field($model, 'event_speaker_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Topic Speakers' ]
                            ])->dropDownList( $items, ['prompt'=>''] ); //, 'multiple'=>'multiple'
                        ?>
                    </div>                       
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                            echo $form->field($model, 'event_moderator_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Moderator' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>

                    </div>
                    <div class="col-md-3">
                    <?php                        
                            $items = ArrayHelper::map(EventLocation::find()->all(), 'id', 'location_name');                                                
                            echo $form->field($model, 'show_location_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Topic Hall' ]
                            ])->dropDownList( $items, ['prompt'=>'', 'onchange'=>'
                                //get spearkers
                                $.post("index.php?r=event-show/event-location-slot-list&id="+$(this).val(), function( data ) {
                                $( "select#eventshow-show_location_slot_id" ).html( data );
                                });                                
                                '] );
                        ?>                                                
                    </div>
                    <div class="col-md-3">
                    <?php                        
                            $items = ArrayHelper::map(EventLocationSlots::find()->all(), 'id', 'slot_name');                                                
                            echo $form->field($model, 'show_location_slot_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Hall Topic Stage' ]
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
                            'options' => ['placeholder' => 'Topic Start Date Time'],
                            'convertFormat' => false,
                            'pluginOptions' => [
                            'format' => 'd-m-yyyy hh:ii',
                            'startDate' => date("d-m-Y h:i"),
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
                            'options' => ['placeholder' => 'Topic Start Date Time'],
                            'convertFormat' => false,
                            'pluginOptions' => [
                            'format' => 'd-m-yyyy hh:ii',
                            'startDate' => date("d-m-Y h:i"),
                            'todayHighlight' => true
                            ]
                            ]
                            );                                             

                        ?>                                                
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'show_description', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=> 'Topic Description' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])
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
 