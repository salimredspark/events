<?php

namespace backend\controllers;

use Yii;
use backend\models\Events;
use backend\models\Settings;
use backend\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Speakers;
use backend\models\SpeakerRole;
use yii\web\UploadedFile;

/**
* EventsController implements the CRUD actions for Events model.
*/
class EventsController extends Controller
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
        $searchModel = new EventsSearch();                
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
        $model = new Events();
        $modelSpeakers = new Speakers();
        $modelSpeakerRole = new SpeakerRole();

        if ($model->load(Yii::$app->request->post())) {

            $eventsPost = Yii::$app->request->post('Events'); 
            $updated_by = Yii::$app->user->identity->id;  

            //upload files
            $uploadObj = UploadedFile::getInstance($model, 'event_banner');                        
            if($uploadObj){
                $filename = md5(time().rand(1111,9999)).'.'.$uploadObj->extension;
                $uploadpath = 'events/'.$filename;
                $uploadObj->saveAs('../../uploads/'.$uploadpath);
                $model->event_banner = $uploadpath;
            }            

            $start_time = date("Y-m-d H:i:s",strtotime($eventsPost['start_time']));                        
            $end_time = date("Y-m-d H:i:s",strtotime($eventsPost['end_time']));

            $model->start_time = $start_time;
            $model->end_time = $end_time;
            $model->updated_by = $updated_by;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
        'model' => $model            
        ]);
    }    

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $eventsPost = Yii::$app->request->post('Events');
            $updated_by = Yii::$app->user->identity->id;  

            //upload files
            $uploadObj = UploadedFile::getInstance($model, 'event_banner');            
            if($uploadObj){
                $filename = md5(time().rand(1111,9999)).'.'.$uploadObj->extension;
                $uploadpath = 'events/'.$filename;
                $uploadObj->saveAs('../../uploads/'.$uploadpath);
                $model->event_banner = $uploadpath;
            }

            $start_time = date("Y-m-d H:i:s",strtotime($eventsPost['start_time']));                        
            $end_time = date("Y-m-d H:i:s",strtotime($eventsPost['end_time']));            
            $model->start_time = $start_time;
            $model->end_time = $end_time;
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
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGetEventInfo($id)
    {
        $eventObj = $this->findModel($id);
        $start_time = $eventObj->start_time;                       
        $end_time = $eventObj->end_time;

        $return ['stime'] = Settings::getConfigDateTime($start_time);
        $return ['etime'] = Settings::getConfigDateTime($end_time);
        
        $_html='';
        $meetingSlots = Settings::SplitTime($start_time, $end_time, "30");
        if(count($meetingSlots) > 0){
            foreach($meetingSlots as $slot){
                $_html .= '<p>'.$slot.'</p>';
            }
        }
        $return ['tslot'] = $_html;
        $return = json_encode($return);
        return $return;
    }
}
