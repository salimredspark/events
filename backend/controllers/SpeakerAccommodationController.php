<?php

namespace backend\controllers;

use Yii;
use backend\models\Speakers;
use backend\models\Events;
use backend\models\IsEventSpeaker;
use backend\models\GeneralCategory;
use backend\models\SpeakerAccommodation;
use backend\models\SpeakerAccommodationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpeakerAccommodationController implements the CRUD actions for SpeakerAccommodation model.
 */
class SpeakerAccommodationController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new SpeakerAccommodationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new SpeakerAccommodation();

        if ($model->load(Yii::$app->request->post())) {
           
            $updated_by = Yii::$app->user->identity->id;  
            $model->manage_by = $updated_by;
            $model->updated_by = $updated_by;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $updated_by = Yii::$app->user->identity->id; 
            $model->updated_by = $updated_by;
            $model->save();
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = SpeakerAccommodation::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionAccommodation($speaker_id, $event_id){
        
        $model = new SpeakerAccommodation();
        $modelEvent = Events::find($event_id)->one();      
        $modelSpeaker = Speakers::find($speaker_id)->one();      
        $modelCategory = GeneralCategory::find()->all();
        
        if ($model->load(Yii::$app->request->post())) {
           
           $post = Yii::$app->request->post('SpeakerAccommodation');
          //echo '<pre>';print_r($post);echo '</pre>';die('developer is working');
           
           if(count($post['vendor_id']) > 0)
           {
               $updated_by = Yii::$app->user->identity->id;               
            
               foreach($post['vendor_id'] as $key => $vendor_id)
               {
                    $category_id = $post['category_id'][$key];
                    $category_item = $post['category_item'][$key];
                    $qty = $post['category_item_qty'][$key];
                    $manage_by = $post['manage_by'][$key];
                    //$vendor_id = $post['vendor_id'][$key];
                    
                    $model->speaker_id = $post['speaker_id'];
                    $model->event_id = $post['event_id'];
                    $model->category_id = $category_id;
                    $model->vendor_id = $vendor_id;
                    $model->category_item = $category_item;
                    $model->category_item_qty = $qty;
                    $model->manage_by = $manage_by;
                    $model->updated_by = $updated_by;
                    $model->save();
               }
           }
           
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('speaker_accommodation', [
            'model' => $model,
            'speaker_id' => $speaker_id,
            'event_id' => $event_id,
            'modelEvent' => $modelEvent,
            'modelSpeaker' => $modelSpeaker,
            'modelCategory' => $modelCategory,
        ]);          
    }
}
