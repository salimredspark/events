<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url; 
use backend\models\User; 
use backend\models\EventType;
use backend\models\EventLocation;
use backend\models\Settings; 

$this->title = $model->event_name;
$this->params['breadcrumbs'][] = ['label' => 'Events', 'url' => ['index']];
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
                            <p class="category">View Event</p>
                        </div>
                        <div class="col-sm-4 pull-right">
                            <?php
                                echo  Html::a('Create New', ['create'], ['class' => 'btn btn-primary']);
                                echo  Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);

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
                            'event_name',
                            'event_domain_name',                        
                            'event_location',
                            #'event_banner',
                            array(
                            'attribute'=>'Banner',                                
                            'format' => 'html',                                
                            'value'=>Html::a('Click Here', '../../uploads/'.$model->event_banner,['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'start_time',                                
                            'value'=>Settings::getConfigDateTime($model->start_time)
                            ),                            
                            array(
                            'attribute'=>'end_time',                                
                            'value'=>Settings::getConfigDateTime($model->end_time)
                            ),
                            array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                            ),
                            'event_description',
                            ],
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div> 