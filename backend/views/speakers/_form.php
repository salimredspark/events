<?php
use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\SpeakerRole;    
    use backend\models\Events;    
    use backend\models\EventType;
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Speaker</h4>
                <p class="category">New Speaker will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>

                <div class="row">                        
                    <div class="col-md-6">
                        <?= $form->field($model, 'speaker_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?php 
                            $items = ArrayHelper::map(SpeakerRole::find()->all(), 'id', 'role_name');                                                
                            echo $form->field($model, 'speaker_role_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Speaker Role' ]
                            ])->dropDownList( $items, ['prompt'=>''] );
                        ?>                        
                    </div>
                     <div class="col-md-3">
                        <?php
                            echo $form->field($model, 'speaker_image')->fileInput();
                            if(!empty($model->speaker_image)){
                                echo Html::a('View Image', '../../uploads/'.$model->speaker_image,['target'=>'_blank']);
                                //echo Html::img('../../uploads/'.$model->speaker_image, ['width'=>'100px']);
                            }
                        ?>                        
                    </div>
                </div>

                <div class="row">    
                    <div class="col-md-12">
                        <?= $form->field($model, 'speaker_details', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label','label' => 'Speaker Bio' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control', ])?>
                    </div>
                </div>


                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
 