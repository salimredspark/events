<?php

    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;
    use backend\models\User; 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\EventTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Event Types';
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
                        <?= Html::a('Create Event Type', ['create'], ['class' => 'btn btn-success']) ?>
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
                        'type_name',
                        'color',
                        /*[
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Color',
                        'format' => 'html',
                        'value' => function ($data) {
                            $options = ['style' => ['width' => '100px', 'height' => '100px']];
                            return Html::tag('p','<div '.Html::addCssStyle($options, 'height: 200px; position: absolute;').'>DD</div>');
                        },
                        ],*/
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