<?php

    use yii\helpers\ArrayHelper;
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm; 
    use backend\models\Events;    
    use backend\models\EventType;    

/* @var $this yii\web\View */
/* @var $model backend\models\Speakers */
/* @var $form yii\widgets\ActiveForm */
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
                    <div class="col-md-12">
                        <?= $form->field($model, 'speaker_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    </div>
                
                <div class="row">    
                     <div class="col-md-12">
                        <?= $form->field($model, 'speaker_details', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                </div>
                              

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
 