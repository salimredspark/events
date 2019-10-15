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
                    <div class="col-sm-8">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-4 pull-right">
                        <?= Html::a('Create Event', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Create Topic', ['event-show/create'], ['class' => 'btn btn-success']) ?>
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
                    /*[
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Domain',
                    'format' => 'html',
                    'value' => function ($data) {
                    #$subdomainUrl = 'http://'.$data->event_domain_name.'.localhost.com';                            
                    $subdomainUrl = Settings::getDomainUrl($data->event_domain_name);
                    return Html::a($data->event_domain_name, $subdomainUrl,['target'=>'_blank']);                            
                    },
                    ],*/
                    #'event_type_id',
                    /*[
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Event Type',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::a(EventType::findOne($data->event_type_id)->type_name, ['event-type/view', 'id'=>$data->event_type_id],['target'=>'_blank']);
                    },
                    ],*/
                    //'event_location',
                    //'event_description',
                    //'start_time',
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
                    [
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Event Manager/Status',
                    'format' => 'html',
                    'value' => function ($data) {
                        $html = Html::a(ucfirst(User::findOne($data->event_manage_by)->username), ['user/view', 'id'=>$data->event_manage_by],['target'=>'_blank']);                                                 
                        $now = date('Y-m-d H:i:s'); $curDate = date("Y-m-d");
                         if (($data->end_time > $now AND $data->start_time <= $now) AND date('Y-m-d',strtotime($data->start_time)) == $curDate){
                            $html .= ' / Active';
                         }elseif($data->start_time >= $now AND date('Y-m-d',strtotime($data->start_time)) == $curDate){
                            $html .= ' / Today';
                         }elseif($data->start_time >= $now  AND date('Y-m-d',strtotime($data->start_time)) != $curDate ){                            
                            $html .= ' / Scheduled';
                         }else{
                            $html .= ' / Closed';
                         }
                        return $html;
                    },
                    ],
                    //'updated_by',
                    [
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Updated By',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Html::a(User::findOne($data->updated_by)->username, ['user/view', 'id'=>$data->updated_by],['target'=>'_blank']); // $data['name'] for array data, e.g. using SqlDataProvider.
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