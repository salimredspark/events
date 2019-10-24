<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\models\SpeakerRole;

$this->title = $model->speaker_name;
$this->params['breadcrumbs'][] = ['label' => 'Speakers', 'url' => ['index']];
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
                            <p class="category">View Speaker</p>
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
                            #'id',
                            'speaker_name',                            
                            array(
                            'attribute'=>'speaker_role_id',                                
                            'label'=>'Speaker Role',                                
                            'format' => 'html',                                
                            'value'=>Html::a(SpeakerRole::findOne($model->speaker_role_id)->role_name, ['speaker-role/view', 'id'=>$model->speaker_role_id],['target'=>'_blank'])
                            ),
                            'speaker_details:ntext',
                            #'updated_by',
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

 