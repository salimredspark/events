<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url; 
use backend\models\User; 
use backend\models\Events; 
use backend\models\Settings;
    use backend\models\Speakers;
    use backend\models\SpeakerRole;
    use backend\models\EventLocation;
    use backend\models\EventLocationSlots;

$this->title = $model->show_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Shows', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <div class="row">
                        <div class="col-sm-8">
                            <h4 class="title"><?= Html::encode($this->title) ?></h4>
                            <p class="category">Event Shows</p>
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
                            //'id',
                            #'event_id',
                            array(
                            'attribute'=>'event_name',                                
                            'format' => 'html',                                
                            'value'=>Html::a(Events::findOne($model->event_id)->event_name, ['events/view', 'id'=>$model->event_id],['target'=>'_blank'])
                            ),
                            'show_name',                            
                             array(
                            'attribute'=>'show_location_id',                                
                            'label'=>'Event Topic Hall',                                
                            'format' => 'html',                                
                            'value'=>Html::a(EventLocation::findOne($model->show_location_id)->location_name, ['event-location/view', 'id'=>$model->show_location_id],['target'=>'_blank'])
                            ),
                             array(
                            'attribute'=>'show_location_slot_id',                                
                            'label'=>'Hall Topic Stage',                                
                            'format' => 'html',                                
                            'value'=>Html::a(EventLocationSlots::findOne($model->show_location_slot_id)->slot_name, ['event-location/view', 'id'=>$model->show_location_slot_id],['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'start_time',                                
                            'value'=>Settings::getConfigDateTime($model->start_time) //date("d M, Y h:i A", strtotime($model->start_time))
                            ),
                            #'updated_at',
                            array(
                            'attribute'=>'end_time',                                
                            'value'=>Settings::getConfigDateTime($model->end_time) //date("d M, Y h:i A", strtotime($model->end_time))
                            ),
                            array(
                            'attribute'=>'event_speaker_id',                                
                            'label'=>'Speaker Name',                                
                            'format' => 'html',                                
                            'value'=>Html::a(Speakers::findOne($model->event_speaker_id)->speaker_name, ['speakers/view', 'id'=>$model->event_speaker_id],['target'=>'_blank'])
                            ),
                             array(
                            'attribute'=>'event_moderator_id',                                
                            'label'=>'Moderator',                                
                            'format' => 'html',                                
                            'value'=>Html::a(Speakers::findOne($model->event_moderator_id)->speaker_name, ['speakers/view', 'id'=>$model->event_moderator_id],['target'=>'_blank'])
                            ),
                             array(
                            'attribute'=>'show_manage_by',                                
                            'label'=>'Show Manage By',
                            'format' => 'html',                                
                            'value'=>Html::a(User::findOne($model->show_manage_by)->username, ['user/view', 'id'=>$model->show_manage_by],['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                            ),
                            'show_description:ntext',
                            ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
            
 