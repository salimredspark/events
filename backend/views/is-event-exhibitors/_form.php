<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    use yii\helpers\Url;
    use yii\helpers\ArrayHelper;
    use backend\models\Events; 
    use backend\models\Exhibitors; 
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title"><?php echo ($model->id)?'Update':'Assign';?> Exhibitor to Event</h4>
                <p class="category">Exhibitor will be assign to event</p>
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-6">
                        <?php                                                
                            $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Name' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div> 
                    <div class="col-md-3">                        
                        <?php                                                
                            $items = ArrayHelper::map(Exhibitors::find()->all(), 'id', 'firstname');
                            echo $form->field($model, 'exhibitor_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Exhibitor Name' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                        ?>
                    </div>
                    <div class="col-md-3">
                    <?php                                                
                            $items = ['yes'=>'Yes', 'no'=>'No', 'maybe'=>'May Be'];                                                
                            echo $form->field($model, 'exhibitor_join_status',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Is Available?' ]
                            ])->dropDownList( $items, ['prompt'=>'']);
                           
                        ?>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12">
                        <?= $form->field($model, 'comment', [
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
 