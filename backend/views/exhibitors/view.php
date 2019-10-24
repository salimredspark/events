<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\User;
use backend\models\Settings; 

$userModel = User::find($model->user_id)->one();

$this->title = $userModel->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Exhibitors', 'url' => ['index']];
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
                            <p class="category">View Exhibitor</p>
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
                            'user.firstname',
                            'user.lastname',
                            'gender',
                            /*array(
                            'attribute'=>'birthdate',                                
                            'value'=>Settings::getConfigDateTime($model->birthdate, 'number', 'date')
                            ),*/
                             array(
                            'attribute'=>'Company Logo',                                
                            'format' => 'html',                                
                            'value'=>Html::a('Click Here', '../../uploads/'.$model->company_logo,['target'=>'_blank'])
                            ),
                            array(
                            'attribute'=>'Profile Image',                                
                            'format' => 'html',                                
                            'value'=>Html::a('Click Here', '../../uploads/'.$userModel->profile_image,['target'=>'_blank'])
                            ),
                            'company_name',
                            'company_site_url',
                            'company_address',
                            'user.username',
                            'user.facebook_profile',
                            'user.instagram_profile',
                            'user.youtube_profile',
                            'user.linkedin_profile',
                            'user.twitter_profile',
                            #'updated_at',            
                            array(
                            'attribute'=>'updated_at',                                
                            'value'=>Settings::getConfigDateTime($model->updated_at)
                            ),
                            array(
                            'attribute'=>'updated_by',                                
                            'format' => 'html',                                
                            'value'=>Html::a(User::findOne($model->updated_by)->username, ['user/view', 'id'=>$model->updated_by],['target'=>'_blank'])
                            ),
                            'company_detail:ntext',
                            ],
                            ]) ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

 