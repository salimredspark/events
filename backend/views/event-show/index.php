<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    
    use yii\helpers\ArrayHelper;    
    use yii\widgets\ActiveForm; 
    use backend\models\Events;
    use backend\models\EventType;
    use kartik\datetime\DateTimePicker;
    use backend\models\User;
    use backend\models\Settings; 

    $this->title = 'Event Show';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="title"><?= Html::encode($this->title) ?> - <?=$event_name;?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <?= Html::a('Search', ['search-event'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
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

                    //'id',
                    'show_name',
                    //'show_location',
                    //'show_description:ntext',
                    #'start_time',
                    #'end_time',
                    [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Start',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Settings::getConfigDateTime($data->start_time);
                        },
                    ],
            #'end_time',
             [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'End',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Settings::getConfigDateTime($data->end_time);
                        },
                    ],
                    //'event_id',
                    [
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Show Manage By',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::a(User::findOne($data->show_manage_by)->username, ['user/view', 'id'=>$data->show_manage_by],['target'=>'_blank']); // $data['name'] for array data, e.g. using SqlDataProvider.
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
                    ['class' => 'yii\grid\ActionColumn',
                    'template'=>'{speaker} {view} {update} {delete}',
                    'contentOptions' => ['style' => 'width: 8.7%'],
                    'visible'=> Yii::$app->user->isGuest ? false : true,
                    'buttons'=>[        
                        'speaker'=>function ($url, $model) {
                            $t = 'index.php?r=speakers/accommodation&id='.$model->id;
                            return  Html::a('<span class="glyphicon glyphicon-user"></span>', $t, ['title' => Yii::t('yii', 'View')]);
                        },
                    ]],
                ],
            ]); ?>


                </div>
            </div>
        </div>
    </div>
</div>