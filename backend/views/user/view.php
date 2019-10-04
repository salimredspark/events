<?php
    use yii\helpers\Html;
    use yii\widgets\DetailView;
    use yii\helpers\Url; 
    use backend\models\Settings; 
    //use backend\models\User

    /* @var $this yii\web\View */
    /* @var $model backend\models\User */

    $this->title = $model->username;
    $this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
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
                            <p class="category">View Profile</p>
                        </div>
                        <div class="col-sm-2 pull-right">
                            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                            <?php
                                if($model::findOne($model->updated_by)->id != Yii::$app->user->identity->id){
                                Html::a('Delete', ['delete', 'id' => $model->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                'confirm' => 'Are you sure you want to delete this item?',
                                'method' => 'post',
                                ],
                                ]);
                            } ?>
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
                            'firstname',
                            'lastname',
                            'username',
                            //'auth_key',
                            //'password_hash',
                            //'password_reset_token',
                            'email:email',
                            //'status',
                            #'created_at',
                            array(
                            'attribute'=>'created_at',                                
                            'value'=>Settings::getConfigDateTime($model->created_at,'stirng')
                            ),
                            #'updated_at',
                            array(
                            'attribute'=>'updated_at',                                
                            'value'=>Settings::getConfigDateTime($model->updated_at,'stirng')
                            ),
                            //'verification_token',
                            #'updated_by',                            
                            array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a($model::findOne($model->updated_by)->username, ['user/view', 'id'=>$model::findOne($model->updated_by)->id],['target'=>'_blank'])
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