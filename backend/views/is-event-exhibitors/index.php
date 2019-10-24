<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\User;
use backend\models\Events;
use backend\models\Exhibitors;

$this->title = 'Event Exhibitors';
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
                        <?= Html::a('Assign Exhibitor to Event', ['create'], ['class' => 'btn btn-success']) ?>                        
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
                            //'event_id',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Event Name',                                
                                'format' => 'html',
                                'value' => function ($data) {
                                    return Html::a(Events::findOne($data->event_id)->event_name, ['events/view', 'id'=>$data->event_id],['target'=>'_blank']);
                                },
                            ],
                            //'exhibitor_id',
                            [
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Exhibitor Name',                                
                                'format' => 'html',
                                'value' => function ($data) {                                                                        
                                    return Html::a(User::findOne($data->exhibitor_id)->firstname, ['exhibitors/view', 'id'=>$data->exhibitor_id],['target'=>'_blank']);
                                },
                            ],
                           // 'exhibitor_join_status',
                           /*[
                                'class' => 'yii\grid\DataColumn',
                                'label' => 'Exhibitor Join?',                                
                                'format' => 'html',
                                'value' => function ($data) {
                                    return ucfirst($data->exhibitor_join_status);
                                },
                            ],*/
                            //'comment:ntext',
                            ['class' => 'yii\grid\ActionColumn'],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div> 