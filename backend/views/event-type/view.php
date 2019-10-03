<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User; 

/* @var $this yii\web\View */
/* @var $model backend\models\EventType */

$this->title = $model->type_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" data-background-color="purple">
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="title"><?= Html::encode($this->title) ?></h4>
                            <p class="category">View Event</p>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?php                                 
                                Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'type_name',
            #'updated_by',
             array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>User::findOne($model->updated_by)->id],['target'=>'_blank'])
                            ),
        ],
    ]) ?>
    
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 