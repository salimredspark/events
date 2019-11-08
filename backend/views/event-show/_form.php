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
<script>
    function makeid(length) {
        var result           = '';
        var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for ( var i = 0; i < length; i++ ) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }
        return result;
    }

    //select speaker
    function selectedSpeaker(obj){        

        var parentId = $(obj).parent().parent().parent().parent().parent().attr("id");    

        if(parseInt(obj.value) > 0){

            //get spearkers
            $.post("index.php?r=speakers/get-speaker&id="+obj.value, function( data ) {                                
                if(parentId == undefined){
                    $( "#eventshow-new_speaker_name" ).attr("readonly",'readonly').val( data['name'] );                
                    $( "#eventshow-event_speaker_role_id").attr("readonly",'readonly').prop('selectedIndex', data['speaker_role_id']);
                    $( "#eventshow-event_speaker_bio" ).attr("readonly",'readonly').val( data['speaker_details'] );
                }else{
                    $( "#"+parentId + " #eventshow-new_speaker_name" ).removeAttr("readonly").val( data['name'] );                
                    $( "#"+parentId + " #eventshow-event_speaker_role_id").removeAttr("readonly").prop('selectedIndex', data['speaker_role_id']);
                    $( "#"+parentId + " #eventshow-event_speaker_bio" ).removeAttr("readonly").val( data['speaker_details'] );
                }
            }, "json");

        }else{
            if(parentId == undefined){
                $( "#eventshow-new_speaker_name").removeAttr("readonly").val('');
                $( "#eventshow-event_speaker_role_id").removeAttr("readonly").prop('selectedIndex', '');
                $( "#eventshow-event_speaker_bio").removeAttr("readonly").val('');            
            }else{
                $( "#"+parentId + " #eventshow-new_speaker_name" ).removeAttr("readonly").val('');                
                $( "#"+parentId + " #eventshow-event_speaker_role_id").removeAttr("readonly").prop('selectedIndex', '');
                $( "#"+parentId + " #eventshow-event_speaker_bio" ).removeAttr("readonly").val('');    
            }
        }
    }

    //add more speaker    
    function addMore(obj){        
        var createHtml = $(".can-addmore-field .row").first().html();        
        $(".class-add-more").append("<div id='child-row-" + makeid(10) + "' class='child-rows-can-delete'><div class='row'>" + createHtml + "</div></div>");
        $(".class-add-more .ignore-addmore-field").html('<?= Html::a('DEL -', 'javascript://', ['class' => 'btn btn-error', 'onclick'=>'removeMore(this)']) ?>');
        $(".class-add-more").show();
    }

    //remove speaker
    function removeMore(obj){
        var divId = $(obj).parent().parent().parent().attr('id');
        $("#"+divId).remove();
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Event Topic</h4>
                        <p class="category">New Event Topic will be create</p>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <?= Html::a('Create Event', ['events/create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Create Topic Type', ['event-type/create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>    
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
                    <div class="col-md-3">
                        <?= $form->field($model, 'show_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=>'Topic Title' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $items = ArrayHelper::map(EventType::find()->all(), 'id', 'type_name');                                                
                            echo $form->field($model, 'topic_type_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Topic Type' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>
                    </div>
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'firstname');                                                
                            echo $form->field($model, 'show_manage_by',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Topic Manage By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                </div> 

                <div class="can-addmore-field"> 
                    <?php 
                        if(count($IsEventSpeaker) > 0){
                            $rows=1;
                            foreach($IsEventSpeaker as $speakerObj){                        
                                $speakerInfo = Speakers::find()->where(['id'=>$speakerObj->event_speaker_id])->one();                                                 
                            ?>
                            <div class="child-rows-can-delete" id="speaker_id_<?=$speakerObj->event_speaker_id;?>">
                                <div class="row">
                                    <div class="col-md-2">
                                        <?php                        
                                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');
                                            echo $form->field($model, 'event_speaker_id[]',[
                                            'template' => "<div class='form-group event_speaker_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Speaker', ]
                                            ])->dropDownList($items, ['options' => [$speakerObj->event_speaker_id => ['Selected'=>'selected']], 'prompt'=>'New', 'onchange'=>'selectedSpeaker(this)'] ); //, 'multiple'=>'multiple'
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php                        
                                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                                            echo $form->field($model, 'new_speaker_name[]',[
                                            'template' => "<div class='form-group new_speaker_name label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Name' ]
                                            ])->textInput(['value'=>$speakerInfo->speaker_name,'maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php                        
                                            $items = ArrayHelper::map(SpeakerRole::find()->all(), 'id', 'role_name');                                                
                                            echo $form->field($model, 'event_speaker_role_id[]',[
                                            'template' => "<div class='form-group event_speaker_role_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Role' ]
                                            ])->dropDownList($items, ['options' => [$speakerInfo->speaker_role_id => ['Selected'=>'selected']],'prompt'=>'']); //, 'multiple'=>'multiple'
                                        ?>
                                    </div>
                                    <div class="col-md-4">
                                        <?php 
                                            echo $form->field($model, 'event_speaker_bio[]',[
                                            'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Bio' ]
                                            ])->textInput(['value'=>$speakerInfo->speaker_details,'maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                                        ?>
                                    </div>
                                    <div class="col-md-1">
                                        <?php                                 
                                            echo $form->field($model, 'event_moderator_id[]',[
                                            'template' => "<div class='form-group event_moderator_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Is Moderator' ]
                                            ])->radio(array(
                                            'label'=>'',
                                            'value'=>$speakerObj->event_speaker_id,                                                                                                
                                            'checked'=>($speakerObj->event_speaker_id == $model->event_moderator_id)?true:false
                                            ))
                                            ->label('Moderator');
                                        ?>
                                    </div>
                                    <div class="col-md-1 ignore-addmore-field">
                                        <?php
                                            if($rows == 1){
                                                echo Html::a('Add +', 'javascript://', ['class' => 'btn btn-success', 'onclick'=>'addMore(this)']);
                                            }else{
                                                echo Html::a('DEL -', 'javascript://', ['class' => 'btn btn-error', 'onclick'=>'removeMore(this)']);                             
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php $rows++;}?>
                        <?php }else{?>
                        <div class="row">
                            <div class="col-md-2">
                                <?php                        
                                    $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                                    echo $form->field($model, 'event_speaker_id[]',[
                                    'template' => "<div class='form-group event_speaker_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Speaker', ]
                                    ])->dropDownList($items, ['prompt'=>'New', 'onchange'=>'selectedSpeaker(this)'] ); //, 'multiple'=>'multiple'
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php                        
                                    $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                                    echo $form->field($model, 'new_speaker_name[]',[
                                    'template' => "<div class='form-group new_speaker_name label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Name' ]
                                    ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                                ?>
                            </div>
                            <div class="col-md-2">
                                <?php                        
                                    $items = ArrayHelper::map(SpeakerRole::find()->all(), 'id', 'role_name');                                                
                                    echo $form->field($model, 'event_speaker_role_id[]',[
                                    'template' => "<div class='form-group event_speaker_role_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Role' ]
                                    ])->dropDownList($items, ['prompt'=>'']); //, 'multiple'=>'multiple'
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?php 
                                    echo $form->field($model, 'event_speaker_bio[]',[
                                    'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Bio' ]
                                    ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                                ?>
                            </div>
                            <div class="col-md-1">
                                <?php 
                                    echo $form->field($model, 'event_moderator_id[]',[
                                    'template' => "<div class='form-group event_moderator_id label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                    'labelOptions' => [ 'class' => 'control-label', 'label' => 'Is Moderator' ]
                                    ])->radio(array(
                                    'label'=>'',
                                    //'labelOptions'=>array('style'=>'padding:5px;'),
                                    //'disabled'=>true
                                    ))
                                    ->label('Moderator');
                                ?>
                            </div>
                            <div class="col-md-1 ignore-addmore-field">
                                <?= Html::a('Add +', 'javascript://', ['class' => 'btn btn-success', 'onclick'=>'addMore(this)']) ?> 
                            </div>                    
                        </div>
                        <?php }?>
                </div>

                <div class="class-add-more"></div>

                <div class="row"> 
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
