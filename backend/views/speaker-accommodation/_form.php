<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\GeneralCategory;
use backend\models\Speakers;
use backend\models\Events;
use backend\models\GeneralVendor;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Speaker Accommodation</h4>
                        <p class="category">New Vendor will be create</p>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <?php //echo Html::a('Create Category', ['general-category/create'], ['class' => 'btn btn-success']) ?>
                        <?php //echo Html::a('Category List', ['general-category/index'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>    
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin(); ?>

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                                                
                            echo $form->field($model, 'speaker_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Speaker' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>                       
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
                         <?php                        
                            $items = ArrayHelper::map(GeneralCategory::find()->all(), 'id', 'category_name');                                                
                            echo $form->field($model, 'category_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Category' ]
                            ])->dropDownList( $items, ['prompt'=>'', 'onchange'=>'                            
                            //get vendor locations
                            $.post("index.php?r=general-vendor/get-vendor&id="+$(this).val(), function( data ) {
                            $( "select#speakeraccommodation-vendor_id" ).html( data );
                            });
                            ']);
                        ?>
                    </div>
                    <div class="col-md-3">
                         <?php                        
                            $items = ArrayHelper::map(GeneralVendor::find()->all(), 'id', 'vendor_name');                                                
                            echo $form->field($model, 'vendor_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Vendor' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>                        
                </div>
            
            <div class="row"> 
                <div class="col-md-6">
                    <?= $form->field($model, 'category_item', [
                    'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'control-label', 'label'=>'Item' ]
                    ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                </div>
                 <div class="col-md-6">
                    <?= $form->field($model, 'category_item_qty', [
                    'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'control-label', 'label'=>'Item Qty' ]
                    ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                </div>
            </div>

            <div class="clearfix"></div>



            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
        </div>
    </div>
</div>

 