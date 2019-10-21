<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User; 
use backend\models\GeneralCategory; 

$this->title = $model->vendor_name;
$this->params['breadcrumbs'][] = ['label' => 'General Vendors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="user-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="title"><?= Html::encode($this->title) ?></h4>
                            <p class="category">View Vendor</p>
                        </div>
                        <div class="col-sm-4 pull-right">
                            <?php
                            echo Html::a('Create New', ['create'], ['class' => 'btn btn-primary']);
                            echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                            
                                echo Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                                ],
                                ]);
                             ?>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div id="typography">
                        <div class="row">
                        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'category_id',
            array(
                            'attribute'=>'Category',                                
                            'format' => 'html',                                
                            'value'=>Html::a(GeneralCategory::findOne($model->category_id)->category_name, ['general-category/view', 'id'=>$model->category_id],['target'=>'_blank'])
                            ),
            'vendor_name',
            'vendor_website',
             array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(User::findOne($model->updated_by)->username), ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                            ),
                            'vendor_detail:ntext',
        ],
    ]) ?>
    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 