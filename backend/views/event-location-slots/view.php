<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User; 
use backend\models\EventLocation; 


$this->title = $model->slot_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Location Slots', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="user-view">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="title"><?= Html::encode($this->title) ?></h4>
                            <p class="category">View Event Location Slot</p>
                        </div>
                        <div class="col-sm-4 pull-right">
                            <?php
                            echo Html::a('Create New', ['create'], ['class' => 'btn btn-primary']);
                            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                            
                                echo Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                                ],
                                ]);
                             ?>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div id="typography">
                        <div class="row">
                         <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                #'id',
                                #'event_location_id',
                                 array(
                                    'attribute'=>'event_location_id',                                
                                    'format' => 'html',                                
                                    'value'=>Html::a(EventLocation::findOne($model->event_location_id)->location_name, ['event-location/view', 'id'=>$model->event_location_id],['target'=>'_blank'])
                                 ),
                                //'slot_type',
                                'slot_name',
                                'slot_detail:ntext',
                                //'updated_by',
                                 array(
                                    'attribute'=>'updated_by',                                
                                    'format' => 'html',                                
                                    'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                                 ),
                            ],
                        ]) ?>    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 