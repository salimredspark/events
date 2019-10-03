<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url; 
use backend\models\User; 
use backend\models\Events; 

/* @var $this yii\web\View */
/* @var $model backend\models\EventShow */

$this->title = $model->show_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Shows', 'url' => ['index']];
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
                            <p class="category">Event Shows</p>
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
            #'event_id',
            array(
                            'attribute'=>'event_id',                                
                            'format' => 'html',                                
                            'value'=>Html::a(Events::findOne($model->event_id)->event_name, ['events/view', 'id'=>$model->event_id],['target'=>'_blank'])
                            ),
            'show_name',
            'show_location',
            'show_description:ntext',            
             array(
                            'attribute'=>'start_time',                                
                            'value'=>date("d M, Y h:i A", strtotime($model->start_time))
                            ),
                            #'updated_at',
                            array(
                            'attribute'=>'end_time',                                
                            'value'=>date("d M, Y h:i A", strtotime($model->end_time))
                            ),
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
            
 