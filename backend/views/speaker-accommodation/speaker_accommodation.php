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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Speaker Accommodation - <?=$modelEvent->event_name;?></h4>
                <p class="category">Add Speaker Accommodation</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <?php foreach($modelCategory as $categoryObj){?>
                <div class="row">                        
                    <div class="col-md-2">                                                
                        <?php echo $categoryObj->category_name;?>
                        <?php 
                                echo $form->field($model, 'category_id[]')->hiddenInput(['value'=> $categoryObj->id])->label(false);
                                echo $form->field($model, 'event_id')->hiddenInput(['value'=> $event_id])->label(false);
                                echo $form->field($model, 'speaker_id')->hiddenInput(['value'=> $speaker_id])->label(false);
                            ?>                        
                    </div>
                    <div class="col-md-2">                                                
                        <?php 
                            $items = ArrayHelper::map(GeneralVendor::find()->where(['category_id'=>$categoryObj->id])->all(), 'id', 'vendor_name');
                            echo $form->field($model, 'vendor_id[]',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Vendor' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                     <div class="col-md-6">
                            <?php 
                                echo $form->field($model, 'category_item[]',[
                                'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Item' ]
                                ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                            ?>
                        </div>
                         <div class="col-md-1">
                            <?php 
                                echo $form->field($model, 'category_item_qty[]',[
                                'template' => "<div class='form-group event_speaker_bio label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                                'labelOptions' => [ 'class' => 'control-label', 'label' => 'Item Qty' ]
                                ])->textInput(['maxlength' => true,'class'=>'form-control']); //, 'multiple'=>'multiple'
                            ?>
                        </div>
                        <div class="col-md-1">                                                
                        <?php 
                            $items = ArrayHelper::map(User::find()->all(), 'id', 'firstname');
                            echo $form->field($model, 'manage_by[]',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Manage By' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                </div>
                <?php }?>

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
 