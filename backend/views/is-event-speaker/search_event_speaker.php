<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    
    use yii\helpers\ArrayHelper;    
    use yii\widgets\ActiveForm; 
    use backend\models\Events;
    use backend\models\EventType;
    use backend\models\EventShow;
    use kartik\datetime\DateTimePicker;

    $this->title = 'Event Speaker';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
            <div class="row">
                    <div class="col-sm-6">
                        <h4 class="title">Search Event Topic Speaker</h4>
                        <p class="category">Select event and search Speaker</p>
                    </div>
                    <div class="col-sm-2 pull-right">                        
                        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>                                    
            </div>
            <div class="card-content">
                <?php $form = ActiveForm::begin(); ?>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                                                
                          $items = ArrayHelper::map(Events::find()->all(), 'id', 'event_name');                                                
                            echo $form->field($model, 'event_id',[
                            'template' => "<div class='form-group label-floating is-empty'>{label}\n{input}</div>\n{hint}\n{error}",
                            'labelOptions' => [ 'class' => 'control-label', 'label' => 'Event Name' ]
                            ])->dropDownList( $items, ['prompt'=>''] );                        
                        ?>
                    </div>                                         
                </div>
                

                <div class="clearfix"></div>                                

                <?= Html::submitButton('Search', ['class' => 'btn btn-success']);?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>