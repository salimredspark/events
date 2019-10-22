<?php
use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\User;
use backend\models\Speakers;
use backend\models\Events;
use backend\models\GeneralCategory;
use backend\models\GeneralVendor;
use yii\helpers\ArrayHelper;
use yii\helpers\Url; 

$this->title = 'Speaker Accommodations';
$this->params['breadcrumbs'][] = $this->title;
?>
<script>
    function searchBySpeakerId(obj){
        var speaker_id = $(obj).val();
        var url = '<?=Url::to(['speaker-accommodation/index', 'speaker_id' => 'SID']);?>';
        url = url.replace('SID',speaker_id);
        location.href = url;
    }
</script>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <div class="row">
                    <div class="col-sm-9">
                        <h4 class="title"><?= Html::encode($this->title) ?>  <?php echo ($speaker_name)?' - '. $speaker_name:'';?></h4>
                        <p class="category">Order by latest first</p>
                    </div>
                    <div class="col-sm-3 pull-right">
                        <?php //echo Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
                        <?php 
                            //echo Html::a('Event Speaker', ['is-event-speaker/search-event'], ['class' => 'btn btn-success']);

                            $items = ArrayHelper::map(Speakers::find()->all(), 'id', 'speaker_name');                        
                            echo Html::dropDownList('speaker_id', $speaker_id, $items, 
                            [
                            //'text' => 'Select', 
                            'onchange'=>'searchBySpeakerId(this)',
                            'class' => 'prompt form-group',
                            //'options' => ['value' => 'none', 'label' => 'Select']
                            ]);
                        ?>
                    </div>
                </div>
            </div>
            <div class="card-content table-responsive">
                <div class="user-index">
                    <?php 
                        echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => [
                        //['class' => 'yii\grid\SerialColumn'],
                        //'speaker_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Speaker',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(Speakers::findOne($data->speaker_id)->speaker_name, ['speakers/view', 'id'=>$data->speaker_id],['target'=>'_blank']);
                        },
                        ],
                        //'event_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Event',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(Events::findOne($data->event_id)->event_name, ['events/view', 'id'=>$data->event_id],['target'=>'_blank']);
                        },
                        ],
                        //'category_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Category',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(GeneralCategory::findOne($data->category_id)->category_name, ['general-category/view', 'id'=>$data->category_id],['target'=>'_blank']);
                        },
                        ],
                        //'vendor_id',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Vendor',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(GeneralVendor::findOne($data->vendor_id)->vendor_name, ['general-vendor/view', 'id'=>$data->vendor_id],['target'=>'_blank']);
                        },
                        ],
                        //'category_item',
                        //'category_item_qty',
                        //'manage_by',
                        [
                        'class' => 'yii\grid\DataColumn',
                        'label' => 'Updated By',
                        'format' => 'html',
                        'value' => function ($data) {
                            return Html::a(User::findOne($data->updated_by)->username, ['user/view', 'id'=>$data->updated_by],['target'=>'_blank']);
                        },
                        ],

                        ['class' => 'yii\grid\ActionColumn'],
                        ],
                        ]); ?>

                </div>
            </div>
        </div>
    </div>
</div> 