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

    $this->title = 'Event Show';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
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
                    'show_location',
                    //'show_description:ntext',
                    #'start_time',
                    #'end_time',
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
                    //'event_id',
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