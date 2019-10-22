<?php
use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\User;    
    use backend\models\Speakers;    
    use backend\models\SpeakerRole;    
    use backend\models\Events;    
    use backend\models\EventType;
    use backend\models\GeneralCategory;
    use backend\models\GeneralVendor;
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

    //select category
    function selectedCategory(obj){        

        var parentId = $(obj).parent().parent().parent().parent().parent().attr("id");    
        //alert(parentId);

        if(parseInt(obj.value) > 0){

            //get spearkers
            $.post("index.php?r=general-vendor/get-vendor&id="+obj.value, function( data ) {                                
                if(parentId == undefined){
                    $( ".can-addmore-field select#speakeraccommodation-vendor_id" ).html( data );
                }else{
                    $( "#"+parentId + " #speakeraccommodation-vendor_id" ).html( data );                    
                }
            });

        }else{
            $( "select#speakeraccommodation-vendor_id" ).html('');
        }
    }

    //add more speaker    
    function addMore(obj){        
        var createHtml = $(".can-addmore-field").html();        
        $(".class-add-more").append("<div id='child-row-" + makeid(10) + "' class='child-rows-can-delete'>" + createHtml + "</div>");
        $(".class-add-more .ignore-addmore-field").html('<?= Html::a('DEL -', 'javascript://', ['class' => 'btn btn-error', 'onclick'=>'removeMore(this)']) ?>');
        $(".class-add-more").show();
    }

    //remove speaker
    function removeMore(obj){
        var divId = $(obj).parent().parent().parent().attr('id');
        $("#"+divId).remove();
    }
</script> <div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Speaker Accommodation - <?=$modelEvent->event_name;?></h4>
                <p class="category">Add Speaker Accommodation</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>                                
                <div class="can-addmore-field">
                    <div class="row">  
                        <div class="col-md-2">                                                                        
                            <?php 
                                $items = ArrayHelper::map(GeneralCategory::find()->all(), 'id', 'category_name');
                                echo $form->field($model, 'category_id',[
                                'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Category' ]
                                ])->dropDownList( $items, ['prompt'=>'','onchange'=>'selectedCategory(this)'
                                ]);
                            ?>                                                
                        </div>                                          
                        <div class="col-md-2">                                                
                            <?php 
                                $items = ArrayHelper::map(GeneralVendor::find()->where(['category_id'=>$model->category_id])->all(), 'id', 'vendor_name');
                                echo $form->field($model, 'vendor_id',[
                                'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Vendor' ]
                                ])->dropDownList( $items, ['prompt'=>''] );
                            ?>                        
                        </div>
                        <div class="col-md-5">
                            <?php 
                                echo $form->field($model, 'category_item',[
                                'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Item' ]
                                ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                            ?>
                        </div>
                        <div class="col-md-1">
                            <?php 
                                echo $form->field($model, 'category_item_qty',[
                                'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Item Qty' ]
                                ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                            ?>
                        </div>
                        <div class="col-md-1">                                                
                            <?php 
                                $items = ArrayHelper::map(User::find()->all(), 'id', 'firstname');
                                echo $form->field($model, 'manage_by',[
                                'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Manage By' ]
                                ])->dropDownList( $items, ['prompt'=>''] );
                            ?>                        
                        </div>
                        <?php if(!$model->id){?>
                        <div class="col-md-1 ignore-addmore-field">
                            <?= Html::a('Add +', 'javascript://', ['class' => 'btn btn-success', 'onclick'=>'addMore(this)']) ?> 
                        </div>
                        <?php }?>
                    </div>                
                </div>                

                <div class="class-add-more"></div>

                <div class="clearfix"></div>                                                
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php
                    echo $form->field($model, 'event_id')->hiddenInput(['value'=> $event_id])->label(false);
                    echo $form->field($model, 'speaker_id')->hiddenInput(['value'=> $speaker_id])->label(false);
                ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
    </div>
 
