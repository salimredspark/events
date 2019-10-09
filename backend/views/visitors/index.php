<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use backend\models\User;
use backend\models\Settings;

$this->title = 'Visitors';
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
                        <?= Html::a('Create New', ['create'], ['class' => 'btn btn-success']) ?>                        
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
                    'visitor_name',
                    'visitor_uid',
                    //'created_at',
                    [
                    'class' => 'yii\grid\DataColumn',
                    'label' => 'Created At',
                    'format' => 'html',
                    'value' => function ($data) {
                        return Settings::getConfigDateTime($data->created_at);
                    },
                    ],
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
 