<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventLocationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Location';
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
                    <div class="col-sm-2 pull-right">
                        <?= Html::a('Create New Location', ['create'], ['class' => 'btn btn-success']) ?>
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

                        'location_name',
                        'location_details',                        
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