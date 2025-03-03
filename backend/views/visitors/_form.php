<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker; 
use yii\jui\DatePicker;
use backend\models\Settings;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Visitor</h4>
                <p class="category">Visitor will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($userModel, 'firstname', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'First Name'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($userModel, 'lastname', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Last Name'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?php
                            echo $form->field($userModel, 'profile_image')->fileInput();
                            if(!empty($userModel->profile_image)){
                                echo Html::a('View Image', '../../uploads/'.$userModel->profile_image,['target'=>'_blank']);
                                //echo Html::img('../../uploads/'.$model->company_logo, ['width'=>'100px']);
                            }
                        ?>                        
                    </div>                                        
                </div>
                <div class="row">
                <div class="col-md-3">
                        <?= $form->field($userModel, 'email', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Email'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div> 
                <div class="col-md-3">
                        <?= $form->field($userModel, 'username', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Username'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                <div class="col-md-3">                   
                        <?= $form->field($userModel, 'password_hash', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Password'  ]
                        ])->passwordInput(['maxlength' => true,'class'=>'form-control', 'value'=>''])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?php
                            $items = array('Male'=>'Male', 'Female'=>'Female');
                            echo $form->field($model, 'gender',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Gender' ]
                            ])->dropDownList( $items, ['prompt'=>''] );                            
                        ?>
                    </div>

                    <div class="col-md-3">
                        <?= $form->field($model, 'visitor_uid', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Visitor ID'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>

                    <div class="col-md-3">                     
                        <?php 
                            $day = '-18y';
                            echo $form->field($model, 'birthdate', [
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' =>'Birthdate'  ]
                            ])->widget(DatePicker::classname(), ['dateFormat' => 'php:M d, Y', 'options' => ['readonly' => true], 'clientOptions' => [ 'changeMonth' => true, 'changeYear' => true, 'yearRange' => '1970:'.date('Y'), 'maxDate' => $day]])                              
                        ?>
                    </div>                     
                </div>
                <div class="row">

                </div>                

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Save', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div> 