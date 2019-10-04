<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\User;
use backend\models\Events;
use backend\models\Speakers;
use backend\models\SpeakerRole;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IsEventSpeakerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Speakers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <?= Html::a('Assign Speaker to Event', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],

                        #'event_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Event Name',
                        'format' => 'html',
                        'value' => function ($data) {                            
                            return Html::a(Events::findOne($data->event_id)->event_name, ['events/view', 'id'=>$data->event_id],['target'=>'_blank']);
                        },
                        ],
                        #'event_speaker_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Speaker Name',
                        'format' => 'html',
                        'value' => function ($data) {                           
                            return Html::a(Speakers::findOne($data->event_speaker_id)->speaker_name, ['speakers/view', 'id'=>$data->event_speaker_id],['target'=>'_blank']);
                        },
                        ],
                        #'event_speaker_role_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Speaker Role',
                        'format' => 'html',
                        'value' => function ($data) {                           
                            return Html::a(SpeakerRole::findOne($data->event_speaker_role_id)->role_name, ['speaker-role/view', 'id'=>$data->event_speaker_role_id],['target'=>'_blank']);
                        },
                        ],
                        
                        /*'role_name',                        
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Updated By',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(User::findOne($data->updated_by)->username, ['user/view', 'id'=>$data->updated_by],['target'=>'_blank']);
                        },
                    ],*/

                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>


                </div>
            </div>
        </div>
    </div>
</div>