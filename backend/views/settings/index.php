<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Settings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-10">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">System Developer Settings</p>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <?= Html::a('Create Settings', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'setting_key',
                    'setting_value:ntext',

                    [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => [],
                        'header'=>'Actions',
                        'template' => '{update}',
                        
                    ],
                ],
            ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
 