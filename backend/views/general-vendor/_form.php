<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\GeneralCategory;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Vendor</h4>
                        <p class="category">New Vendor will be create</p>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <?= Html::a('Create Category', ['general-category/create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Category List', ['general-category/index'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>    
            </div>
            <div class="card-content">

                <?php $form = ActiveForm::begin(); ?>

                <div class="row"> 
                    <div class="col-md-3">
                        <?php                        
                            $items = ArrayHelper::map(GeneralCategory::find()->all(), 'id', 'category_name');                                                
                            echo $form->field($model, 'category_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Select Category' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>                       
                    <div class="col-md-6">
                        <?= $form->field($model, 'vendor_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=>'Vendor Name' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'vendor_website', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=>'Vendor Website' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>                        
                </div>
            
            <div class="row"> 
                <div class="col-md-12">
                    <?= $form->field($model, 'vendor_detail', [
                    'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'control-label', 'label'=>'Vendor Detail' ]
                    ])->textArea(['maxlength' => true,'class'=>'form-control'])?>
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
