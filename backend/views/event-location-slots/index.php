<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\User;
use backend\models\EventLocation;

$this->title = 'Event Hall Stage';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <?= Html::a('Create New', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Create Location', ['event-location/create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            #['class' => 'yii\grid\SerialColumn'],
                            #'id',
                            #'event_location_id',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Event Hall',
                                'filter' => true,
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::a(EventLocation::findOne($data->event_location_id)->location_name, ['event-location/view', 'id'=>$data->event_location_id],['target'=>'_blank']);
                                },
                            ],
                            //'slot_type',
                            'slot_name',
                            //'slot_detail:ntext',
                            //'updated_by',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Updated By',
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::a(User::findOne($data->updated_by)->username, ['user/view', 'id'=>$data->updated_by],['target'=>'_blank']);
                                },
                            ],

                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 