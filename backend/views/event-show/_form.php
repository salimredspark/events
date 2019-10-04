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
    use kartik\datetime\DateTimePicker;
    
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Event Show</h4>
                <p class="category">New Event Show will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');                                                
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Name' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>                       
                    <div class="col-md-3">
                        <?= $form->field($model, 'show_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'show_location', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])
                        ?>
                    </div>
                </div> 

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                            echo $form->field($model, 'event_speaker_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Name' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>                       
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(SpeakerRole::find()->all(), 'id', 'role_name');                                                
                            echo $form->field($model, 'event_speaker_role_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Role' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>

                    </div>

                    <div class="col-md-6">
                        <?php                        
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'username');                                                
                            echo $form->field($model, 'show_manage_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Show Manage By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'show_description', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <?php
                            /* $form->field($model, 'start_time', [
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label' ]
                            ])->textInput(['maxlength' => true,'class'=>'form-control'])*/                                                  

                            echo $form->field($model, 'start_time')->widget(
                            DateTimePicker::class, 
                            [
                            'options' => ['placeholder' => 'Event Start Date Time'],
                            'convertFormat' => false,
                            'pluginOptions' => [
                            'format' => 'd-M-yyyy hh:ii P',
                            'startDate' => '01-Mar-2014 12:00 AM',
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
                            'options' => ['placeholder' => 'Event Start Date Time'],
                            'convertFormat' => false,
                            'pluginOptions' => [
                            'format' => 'd-M-yyyy hh:ii P',
                            'startDate' => '01-Mar-2014 12:00 AM',
                            'todayHighlight' => true
                            ]
                            ]
                            );                                             

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
 