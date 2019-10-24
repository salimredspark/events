<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\datetime\DateTimePicker; 
use yii\jui\DatePicker;
use backend\models\Settings;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Create';?> Exhibitor</h4>
                <p class="category">Exhibitor will be create</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
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
                            $items = array('Male'=>'Male', 'Female'=>'Female');
                            echo $form->field($model, 'gender',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Gender' ]
                            ])->dropDownList( $items, ['prompt'=>''] );                            
                        ?>
                    </div>
                    <div class="col-md-3">                    
                        <?php
                            echo $form->field($model, 'company_logo')->fileInput();
                            if(!empty($model->company_logo)){
                                echo Html::a('View Image', '../../uploads/'.$model->company_logo,['target'=>'_blank']);
                                //echo Html::img('../../uploads/'.$model->company_logo, ['width'=>'100px']);
                            }
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($model, 'company_name', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Company Name'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'company_site_url', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Company Website'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'company_address', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Company Address'  ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'company_detail', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textArea(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($userModel, 'country', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($userModel, 'technology', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>                    
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($userModel, 'username', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($userModel, 'email', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($userModel, 'password_hash', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label', 'label' =>'Password' ]
                        ])->passwordInput(['maxlength' => true,'class'=>'form-control','value'=>''])?>
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
                    <div class="col-md-4">
                        <?= $form->field($userModel, 'facebook_profile', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($userModel, 'instagram_profile', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($userModel, 'youtube_profile', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($userModel, 'linkedin_profile', [
                        'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                        'labelOptions' => [ 'class' => 'control-label' ]
                        ])->textInput(['maxlength' => true,'class'=>'form-control'])?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($userModel, 'twitter_profile', [
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