<?php
    use yii\helpers\Html;
    use yii\grid\GridView;
    use yii\helpers\Url;

    $this->title = 'Admin Users List';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-10">
                        <h4 class="title"><?= Html::encode($this->title) ?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-2 pull-right">
                        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

                    <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                    //['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    'firstname',                    
                    'lastname',
                    'username',
                    //'auth_key',
                    //'password_hash',
                    //'password_reset_token',
                    'email:email',
                    //'login_type',
                    [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Login as',
                        'format' => 'html',
                        'value' => function ($data) {
                            return ucfirst($data->login_type);
                        },
                    ],
                    //'status',
                    //'created_at',
                    //'updated_at',
                    //'verification_token',
                    //'updated_by',
                    //'firstname',
                    //'lastname',
                    /*[
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{download} {view} {update} {delete}',
                    'buttons' => [
                    'download' => function ($url) {
                    return Html::a(
                    '<span class="glyphicon glyphicon-arrow-down"></span>',
                    $url, 
                    [
                    'title' => 'Download',
                    'data-pjax' => '0',
                    ]
                    );
                    },
                    ],
                    ],*/

                    ['class' => 'yii\grid\ActionColumn'],
                    ],
                    ]); ?>


                </div>
            </div>
        </div>
    </div>
                </div>