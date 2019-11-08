<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\User; 
use backend\models\Events;  
use backend\models\Settings;  
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
                            $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Event' ]
                            ])->dropDownList( $items, ['prompt'=>'', 'onchange'=>'                            
                            //get event locations
                            $.post("index.php?r=events/get-event-info&id="+$(this).val(), function( data ) {

                            $( ".event_start_time" ).html( data.stime );
                            $( ".event_end_time" ).html( data.etime );
                            $( ".meeting_time_slot" ).html( data.tslot );
                            },"json");
                            ']);
                        ?>
                    </div>
                    <div class="col-md-3">                        
                        <?php                                                
                            #$items = ArrayHelper::map(Exhibitors::find()->joinWith('user', true, 'RIGHT JOIN')->where(['user.login_type' => "exhibitor"])->all(), 'id', 'user.firstname');
                            $items = ArrayHelper::map(User::find()->where(['login_type' => "exhibitor"])->all(), 'id', 'firstname');
                            echo $form->field($model, 'exhibitor_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Exhibitor' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(EventLocation::find()->all(), 'id', 'location_name');                                                
                            echo $form->field($model, 'event_location_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Hall' ]
                            ])->dropDownList( $items, ['prompt'=>'', 'onchange'=>'                            
                            //get event locations
                            $.post("index.php?r=event-show/event-location-slot-list&id="+$(this).val(), function( data ) {
                            $( "select#iseventexhibitors-event_location_booth_id" ).html( data );
                            });
                            ']);
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(EventLocationBooth::find()->all(), 'id', 'booth_name');                                                
                            echo $form->field($model, 'event_location_booth_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Hall Booth' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'comment', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])?>
                    </div>                     
                </div>                


                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?> 
                <div class="row">
                    <div class="col-md-6">
                        <h4><strong>Event Date Time</strong></h4>                        
                        <?php
                            $eventObj = Events::find($model->event_id)->one();
                            $start_time = $eventObj->start_time;                       
                            $end_time = $eventObj->end_time;                       
                        ?>
                        <p>Start Time - <span class="event_start_time"><?php echo Settings::getConfigDateTime($start_time);?></span></p>
                        <p>End Time - <span class="event_end_time"><?php echo Settings::getConfigDateTime($end_time);?></span></p>
                    </div>                     
                </div>                     

                <?php
                    $meetingSlots = Settings::SplitTimeByDate($start_time, $end_time, "30", $model->exhibitor_id,$model->event_id );
                    //echo '<pre>';print_r($meetingSlots);echo '</pre>';die('developer is working');
                    
                    if(count($meetingSlots) >0){
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                            <h4><strong>Meeting Time Slot</strong></h4>
                            <div class="meeting_time_slot">
                                <?php
                                    foreach($meetingSlots as $slots){
                                        $cols = (round(count($meetingSlots) / 2) );
                                    ?>
                                    <div class="col-md-<?=$cols;?>">
                                        <strong>Date: <?=$slots['date'];?></strong>
                                        <hr/>
                                        <?php 
                                            if(isset($slots['timeslots'])){
                                                foreach($slots['timeslots'] as $slot){?>
                                                <p><?php echo $slot['slot'];?></p> 
                                                <?php 
                                                }
                                            }
                                        ?>
                                    </div>
                                    <?php } ?>                                                                                                                      
                            </div>                     
                        </div>                     
                    </div>                
                    <?php }?>            
                <div class="clearfix"></div>                                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
 