<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\Events; 
use backend\models\Exhibitors; 
    
$this->title = 'View Exhibitor Event';
$this->params['breadcrumbs'][] = ['label' => 'Is Event Exhibitors', 'url' => ['index']];
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
                                    //'event_id',
                                     array(
                                    'attribute'=>'event_id',                                
                                    'label' => 'Event Name',
                                    'format' => 'html',                                
                                    'value'=>Html::a(Events::findOne($model->event_id)->event_name, ['events/view', 'id'=>$model->event_id],['target'=>'_blank'])
                                 ),
                                    #'exhibitor_id',                                    
                                    array(
                                    'label' => 'Exhibitor Name',
                                    'attribute'=>'event_id',                                
                                    'format' => 'html',                                
                                    'value'=>Html::a(Exhibitors::findOne($model->exhibitor_id)->firstname, ['exhibitors/view', 'id'=>$model->exhibitor_id],['target'=>'_blank'])
                                 ),
                                    #'exhibitor_join_status',
                                    array(
                                    'label' => 'Exhibitor Join?',
                                    'attribute'=>'exhibitor_join_status',                                
                                    'format' => 'html',                                
                                    'value'=> ucfirst($model->exhibitor_join_status)
                                 ),
                                    'comment:ntext',
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
 