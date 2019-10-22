<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User; 
use backend\models\Events; 
use backend\models\Speakers; 
use backend\models\GeneralCategory; 
use backend\models\GeneralVendor; 

$this->title = 'View Accommodation';
$this->params['breadcrumbs'][] = ['label' => 'Speaker Accommodations', 'url' => ['index']];
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
                            
                        </div>
                        <div class="col-sm-4 pull-right">
                            <?php
                                //echo Html::a('Create New', ['create'], ['class' => 'btn btn-primary']);
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
                            //'id',
                            array(
                            'attribute'=>'speaker_id',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(Speakers::findOne($model->speaker)->speaker_name), ['speakers/view', 'id'=>$model->speaker_id],['target'=>'_blank'])
                            ),
                             array(
                            'attribute'=>'event_id',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(Events::findOne($model->event_id)->event_name), ['events/view', 'id'=>$model->event_id],['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'Category',                                
                            'format' => 'html',                                
                            'value'=>Html::a(GeneralCategory::findOne($model->category_id)->category_name, ['general-category/view', 'id'=>$model->category_id],['target'=>'_blank'])
                            ),                            
                             array(
                            'attribute'=>'vendor_id',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(GeneralVendor::findOne($model->vendor_id)->vendor_name), ['general-vendor/view', 'id'=>$model->vendor_id],['target'=>'_blank'])
                            ),
                            'category_item',
                            'category_item_qty',
                            array(
                            'attribute'=>'manage_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(User::findOne($model->manage_by)->username), ['user/view', 'id'=>$model->manage_by],['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(ucfirst(User::findOne($model->updated_by)->username), ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
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