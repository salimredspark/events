<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Events;
use backend\models\Speakers;
use backend\models\SpeakerRole;

/* @var $this yii\web\View */
/* @var $model backend\models\IsEventSpeaker */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Is Event Speakers', 'url' => ['index']];
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
                            <h4 class="title">View Event Speaker</h4>
                            <p class="category">View Event Speaker</p>
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
                               // 'id',
                                //'event_id',
                                array(
                                    'attribute'=>'event_id',                                
                                    'label'=>'Event Name',
                                    'format' => 'html',                                
                                    'value'=>Html::a(Events::findOne($model->event_id)->event_name, ['events/view', 'id'=>$model->event_id],['target'=>'_blank'])
                                    ),
                                #'event_speaker_id',
                                array(
                                    'attribute'=>'event_speaker_id',                                
                                    'label'=>'Event Speaker Name',
                                    'format' => 'html',                                
                                    'value'=>Html::a(Speakers::findOne($model->event_speaker_id)->speaker_name, ['speakers/view', 'id'=>$model->event_speaker_id],['target'=>'_blank'])
                                    ),
                                #'event_speaker_role_id',
                                array(
                                    'attribute'=>'event_speaker_role_id',                                
                                    'label'=>'Speaker Role',
                                    'format' => 'html',                                
                                    'value'=>Html::a(SpeakerRole::findOne($model->event_speaker_role_id)->role_name, ['speaker-role/view', 'id'=>$model->event_speaker_role_id],['target'=>'_blank'])
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