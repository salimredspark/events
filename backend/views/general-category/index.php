<?php

use yii\helpers\Html;
use yii\grid\GridView;
    use yii\helpers\Url;
    use backend\models\User;

$this->title = 'General Categories';
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
                    <div class="col-sm-3 pull-right">
                        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
                        <?= Html::a('Vendor', ['general-vendor/index'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                            //['class' => 'yii\grid\SerialColumn'],

                            //'id',
                            'category_name',
                            'category_detail',
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
 