<?php
    use yii\helpers\Url; 
    use yii\helpers\Html;   
    use yii\widgets\ActiveForm;     
?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> User</h4>
                <p class="category">Admin user will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'firstname', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'lastname', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                     <div class="col-md-3">
                        <?php
                            echo $form->field($model, 'profile_image')->fileInput();
                            if(!empty($model->profile_image)){
                                echo Html::a('View Image', '../../uploads/'.$model->profile_image,['target'=>'_blank']);
                                //echo Html::img('../../uploads/'.$model->company_logo, ['width'=>'100px']);
                            }
                        ?>                        
                    </div>
                </div>

                <div class="row">                        
                    <div class="col-md-3">
                        <?= $form->field($model, 'username', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>                                                
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'password_hash', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label'=>'Password' ]
                        ])->passwordInput(['maxlength' => true,'class'=>'form-control', 'value'=>''])?>                                                
                    </div>
                    
                    <div class="col-md-6">
                        <?= $form->field($model, 'email', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>                                                
                    </div>
                    
                </div>                            
                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>