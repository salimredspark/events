<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use yii\helpers\Url;
use backend\models\Events;
use backend\models\Speakers;
use backend\models\SpeakerRole;
use backend\models\Hotels; 
use backend\models\User; 

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventSpeaker */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Assign';?> Event Speaker</h4>
                <p class="category">Assign Speaker to Event</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
               
                <div class="row">                        
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');                                                
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event' ]
                            ])->dropDownList( $items, ['prompt'=>'', 'onchange'=>'
                                $.post("index.php?r=event-show/event-spekers-list&id="+$(this).val(), function( data ) {
                                $( "select#iseventspeaker-event_speaker_id" ).html( data );
                                });
                                '] );
                        ?>
                    </div>
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
                     <div class="col-md-3">
                    <?php                        
                            $items = Hotels::getTravelOption();
                            echo $form->field($model, 'speaker_travel_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Travel' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?> 
                        </div>                   
                </div>
                 <div class="row">
                <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Hotels::find()->all(), 'id', 'hotel_name');                                                
                            echo $form->field($model, 'hotel_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Hotel Name' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>
                    <div class="col-md-3">
                    <?= $form->field($model, 'hotel_room_number', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>                        
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'username');                                                
                            echo $form->field($model, 'hotel_book_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Hotel Book By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = $items = Hotels::getHotelPatnerOption();
                            echo $form->field($model, 'hotel_patner',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Hotel Patner' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
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