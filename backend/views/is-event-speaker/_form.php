<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper; 
use yii\helpers\Url;
use backend\models\Events;
use backend\models\Speakers;
use backend\models\SpeakerRole;

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
                            ])->dropDownList( $items, ['prompt'=>''] );
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
                </div>
                              

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div> 