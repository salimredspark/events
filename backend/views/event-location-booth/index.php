<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Exhibitors;
use backend\models\EventLocation;
use backend\models\User;

$this->title = 'Event Location Booths';
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
                    <div class="col-sm-2 pull-right">
                        <?= Html::a('Create Event Location Booth', ['create'], ['class' => 'btn btn-success']) ?>                        
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">                    
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],
                            //'id',
                            //'event_location_id',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Hall Name',                                
                                'format' => 'html',
                                'value' => function ($data) {                                                                        
                                    return Html::a(EventLocation::findOne($data->event_location_id)->location_name, ['event-location/view', 'id'=>$data->event_location_id],['target'=>'_blank']);
                                },
                            ],
                            'booth_name',                                                        
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Updated By',                                
                                'format' => 'html',
                                'value' => function ($data) {                                                                        
                                    return Html::a(User::findOne($data->updated_by)->firstname, ['user/view', 'id'=>$data->updated_by],['target'=>'_blank']);
                                },
                            ],
                            'booth_detail:ntext',                            
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 