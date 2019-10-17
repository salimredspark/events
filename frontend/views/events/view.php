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
<div class="header-image" style="background-image:url('../../uploads/<?=(!$model->event_banner)?'/events/default/default.jpg':$model->event_banner;?>')">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1><?= Html::encode($this->title) ?></h1>
            <p><?=$model->event_description;?></p>        
        </div>
        <div class="col-md-6">
        </div>
    </div>
    </div>
</div>
<div class="container">
<div class="event-view">            
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-content">
                    <div id="typography">
                        <div class="row">
                            <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [                                                        
                            'event_domain_name',                                                        
                            'event_location',                            
                            array(
                            'attribute'=>'start_time',                                
                            'value'=>Settings::getConfigDateTime($model->start_time)
                            ),                            
                            array(
                            'attribute'=>'end_time',                                
                            'value'=>Settings::getConfigDateTime($model->end_time)
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
</div>