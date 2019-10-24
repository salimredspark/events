<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User; 
use backend\models\Events; 
use backend\models\Exhibitors; 
use backend\models\EventLocation; 
use backend\models\EventLocationBooth;

$this->title = $model->booth_name;
$this->params['breadcrumbs'][] = ['label' => 'Event Location Booths', 'url' => ['index']];
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
                            <p class="category">View Exhibitor Event</p>
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
                            <?php
                                echo DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                //'id',                                
                                array(
                                'attribute'=>'event_location_id',                                
                                'label'=>'Topic Hall',
                                'format' => 'html',                                
                                'value'=>Html::a(EventLocation::findOne($model->event_location_id)->location_name, ['event-location/view', 'id'=>$model->event_location_id],['target'=>'_blank'])
                                ), 
                                'booth_name',                                                                
                                array(
                                'attribute'=>'updated_by',                                
                                'label'=>'Updated By',
                                'format' => 'html',                                
                                'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                                ),
                                'booth_detail:ntext',                                 
                                ],
                                ])
                            ?>    

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 