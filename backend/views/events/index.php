<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use backend\models\User; 
    use backend\models\EventType; 
    use backend\models\Settings; 

    $this->title = 'Events';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-10">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
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
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'event_name',
            #'event_domain_name',
            [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Domain',
                        'format' => 'html',
                        'value' => function ($data) {
                            #$subdomainUrl = 'http://'.$data->event_domain_name.'.localhost.com';                            
                            $subdomainUrl = Settings::getDomainUrl($data->event_domain_name);
                            return Html::a($data->event_domain_name, $subdomainUrl,['target'=>'_blank']);                            
                        },
                    ],
            #'event_type_id',
            [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Event Type',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(EventType::findOne($data->event_type_id)->type_name, ['event-type/view', 'id'=>$data->event_type_id],['target'=>'_blank']);
                        },
                    ],
            //'event_location',
            //'event_description',
            //'start_time',
            [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Start',
                        'format' => 'html',
                        'value' => function ($data) {
                           return date("d M, Y h:i A", strtotime($data->start_time)); 
                        },
                    ],
            #'end_time',
             [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'End',
                        'format' => 'html',
                        'value' => function ($data) {
                            return date("d M, Y h:i A", strtotime($data->end_time));
                        },
                    ],
            //'updated_by',
            [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Updated By',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(User::findOne($data->updated_by)->username, ['user/view', 'id'=>User::findOne($data->updated_by)->id],['target'=>'_blank']); // $data['name'] for array data, e.g. using SqlDataProvider.
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