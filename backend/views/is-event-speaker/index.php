<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\IsEventSpeakerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Is Event Speakers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="is-event-speaker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Is Event Speaker', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'event_id',
            'event_speaker_id',
            'event_speaker_role_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
