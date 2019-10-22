<?php

namespace backend\controllers;

use Yii;
use backend\models\Events;
use backend\models\EventShow;
use backend\models\EventShowSearch;
use backend\models\IsEventSpeaker;
use backend\models\Speakers;
use backend\models\EventLocation;
use backend\models\EventLocationSlots;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* EventShowController implements the CRUD actions for EventShow model.
*/
class EventShowController extends Controller
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

    public function actionSearchEvent()
    {
        $model = new EventShow();

        //search event show
        if ($model->load(Yii::$app->request->post()) || Yii::$app->session->get('global_event_id')) {                        
            $event_id = Yii::$app->session->get('global_event_id');
            if(!$event_id){
                $post = Yii::$app->request->post()['EventShow'];
                $event_id = $post['event_id'];
            }


            $searchModel = new EventShowSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere('event_id = '.$event_id);

            $event_name = Events::findOne($event_id)->event_name;

            return $this->render('index', [
            'event_name'=> $event_name,             
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('search_event_show', [
        'model' => $model,
        'event_name' => ''
        ]);
    }

    public function actionIndex()
    {
        $searchModel = new EventShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $event_id = Yii::$app->session->get('global_event_id');
        $event_name = false;        
        if($event_id > 0){
            $dataProvider->query->andWhere('event_id = '.$event_id);
            $event_name = Events::findOne($event_id)->event_name;            
        }

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'event_id' => $event_id,
        'event_name' => $event_name,
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
        $model = new EventShow();

        /*if ($model->load(Yii::$app->request->post())) {

        $eventsPost = Yii::$app->request->post('EventShow');

        $updated_by = Yii::$app->user->identity->id;  
        $start_time = date("Y-m-d h:i:s",strtotime($eventsPost['start_time']));                        
        $end_time = date("Y-m-d h:i:s",strtotime($eventsPost['end_time']));

        $model->start_time = $start_time;
        $model->end_time = $end_time;
        $model->updated_by = $updated_by;
        $model->save();
        return $this->redirect(['view', 'id' => $model->id]);
        }*/

        if (Yii::$app->request->post()) {
            $eventsPost = Yii::$app->request->post('EventShow');                        

            $moderator = array_filter($eventsPost['event_moderator_id']);
            $event_moderator_id = $moderator[key($moderator)];

            $updated_by = Yii::$app->user->identity->id;  
            $start_time = date("Y-m-d h:i:s",strtotime($eventsPost['start_time']));                        
            $end_time = date("Y-m-d h:i:s",strtotime($eventsPost['end_time']));
            
            $model->event_id = $eventsPost['event_id'];            
            $model->show_name = $eventsPost['show_name'];
            $model->show_manage_by = $eventsPost['show_manage_by'];
            $model->event_moderator_id = $event_moderator_id;
            $model->show_location_id = $eventsPost['show_location_id'];
            $model->show_location_slot_id = $eventsPost['show_location_slot_id'];
            $model->show_description = $eventsPost['show_description'];
            $model->start_time = $start_time;
            $model->end_time = $end_time;
            $model->updated_by = $updated_by;
            $model->save();
            $show_id = $model->id;
            
            $thisTopicSpeakers=[];
            if($show_id > 0){
                //save new or exist speakers                            
                $noOfSpeakerSelected = $eventsPost['event_speaker_id'];

                foreach($noOfSpeakerSelected as $k => $speaker_id){                   
                    if($speaker_id){
                        //exist speaker
                        $thisTopicSpeakers[]=$speaker_id;                        
                        $thisTopicSpeakersRole[$speaker_id] = $eventsPost['event_speaker_role_id'][$k];
                    }else{                      
                        //save new speaker    
                        $modelSpeakers = new Speakers();
                        $modelSpeakers->speaker_name = $eventsPost['new_speaker_name'][$k];
                        $modelSpeakers->speaker_role_id = $eventsPost['event_speaker_role_id'][$k];
                        $modelSpeakers->speaker_details = $eventsPost['event_speaker_bio'][$k];
                        $modelSpeakers->updated_by = $updated_by;
                        $modelSpeakers->save();
                        $new_speaker_id=$modelSpeakers->id;
                        $thisTopicSpeakers[]=$new_speaker_id;
                        $thisTopicSpeakersRole[$new_speaker_id] = $eventsPost['event_speaker_role_id'][$k];
                    }
                }


                if(count($thisTopicSpeakers) > 0){
                    //assign spekars to Show
                    IsEventSpeaker::deleteAll('event_id = '.$eventsPost['event_id']);
                    foreach($thisTopicSpeakers as $speaker_id){
                        $IsEventSpeaker = new IsEventSpeaker();
                        $IsEventSpeaker->event_id = $eventsPost['event_id'];
                        $IsEventSpeaker->show_id = $show_id;
                        $IsEventSpeaker->event_speaker_id = $speaker_id;
                        $IsEventSpeaker->event_speaker_role_id = $thisTopicSpeakersRole[$speaker_id];
                        $IsEventSpeaker->event_location_id = $eventsPost['show_location_id'];
                        $IsEventSpeaker->event_location_slot_id = $eventsPost['show_location_slot_id'];
                        $IsEventSpeaker->save();
                    }
                }
            }
                        
            return $this->redirect(['view', 'id' => $show_id]);
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $eventsPost = Yii::$app->request->post('EventShow');                        

            $updated_by = Yii::$app->user->identity->id;  
            $start_time = date("Y-m-d h:i:s",strtotime($eventsPost['start_time']));                        
            $end_time = date("Y-m-d h:i:s",strtotime($eventsPost['end_time']));
            $model->start_time = $start_time;
            $model->end_time = $end_time;
            $model->updated_by = $updated_by;
            $model->save();
            $show_id = $model->id;                                            

            //save new or exist speakers            
            $thisTopicSpeakers=[];
            $noOfSpeakerSelected = $eventsPost['event_speaker_id'];

            foreach($noOfSpeakerSelected as $k => $speaker_id){                   
                if($speaker_id){
                    //exist speaker
                    $thisTopicSpeakers[]=$speaker_id;                        
                    $thisTopicSpeakersRole[$speaker_id] = $eventsPost['event_speaker_role_id'][$k];
                }else{                      
                    //save new speaker    
                    $modelSpeakers = new Speakers();
                    $modelSpeakers->speaker_name = $eventsPost['new_speaker_name'][$k];
                    $modelSpeakers->speaker_role_id = $eventsPost['event_speaker_role_id'][$k];
                    $modelSpeakers->speaker_details = $eventsPost['event_speaker_bio'][$k];
                    $modelSpeakers->updated_by = $updated_by;
                    $modelSpeakers->save();
                    $new_speaker_id=$modelSpeakers->id;
                    $thisTopicSpeakers[]=$new_speaker_id;
                    $thisTopicSpeakersRole[$new_speaker_id] = $eventsPost['event_speaker_role_id'][$k];
                }
            }

            //assign spekars to Show
            IsEventSpeaker::deleteAll('event_id = '.$eventsPost['event_id']);
            foreach($thisTopicSpeakers as $speaker_id){
                $IsEventSpeaker = new IsEventSpeaker();
                $IsEventSpeaker->event_id = $eventsPost['event_id'];
                $IsEventSpeaker->show_id = $show_id;
                $IsEventSpeaker->event_speaker_id = $speaker_id;
                $IsEventSpeaker->event_speaker_role_id = $thisTopicSpeakersRole[$speaker_id];
                $IsEventSpeaker->event_location_id = $eventsPost['show_location_id'];
                $IsEventSpeaker->event_location_slot_id = $eventsPost['show_location_slot_id'];
                $IsEventSpeaker->save();
            }

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
        if (($model = EventShow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEventSpekersList($id){        
        $speakers = IsEventSpeaker::find()->where(['event_id'=>$id])->orderBy('id DESC')->all();
        if(count($speakers) > 0){
            foreach($speakers as $speaker){
                $speakersinfo = Speakers::find()->where(['id'=>$speaker->id])->one();
                echo "<option value='".$speaker->id."'>".$speakersinfo->speaker_name."</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }

    public function actionEventLocationList($id){        
        $location = IsEventSpeaker::find()->where(['event_id'=>$id])->orderBy('id DESC')->one();        
        if(isset($location->event_location_id)){            
            $locationInfo = EventLocation::find()->where(['id'=>$location->event_location_id])->one();
            echo "<option value='".$location->id."'>".$locationInfo->location_name."</option>";
        }else{
            echo "<option>-</option>";
        }
    }

    public function actionEventLocationSlotList($id){        
        $locationSlots = EventLocationSlots::find()->where(['event_location_id'=>$id])->orderBy('slot_name ASC')->all();        
        if(count($locationSlots)){
            foreach($locationSlots as $locationSlot){
                echo "<option value='".$locationSlot->id."'>".$locationSlot->slot_name."</option>";
            }
        }else{
            echo "<option>-</option>";
        }
    }
}
