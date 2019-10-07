<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\Events;
use backend\models\EventShow;
use backend\models\Speakers;

class DashboardController extends Controller
{
        
    public function behaviors()
    {
        return [
        'access' => [
        'class' => AccessControl::className(),
        'rules' => [        
        [
        'actions' => ['index'],
        'allow' => true,
        'roles' => ['@'],
        ],
        ],
        ],        
        ];
    }
        
    public function actions()
    {
        return [
        'error' => [
        'class' => 'yii\web\ErrorAction',
        ],
        ];
    }
        
    public function actionIndex()
    {
        $this->view->title = 'Dashboard';
        
        //events
        $total_events = Events::find()->count();
        $today = date('Y-m-d h:i:s');
        $total_active_events = Events::find()->where([ '>=', 'end_time', $today])->count();
        
        //events Shows
        $total_eventshows = EventShow::find()->count();
        $today = date('Y-m-d h:i:s');
        $total_active_eventshows = EventShow::find()->where([ '>=', 'end_time', $today])->count();
        
        //
        $total_speakers = Speakers::find()->count();;
        
        return $this->render('dashboard', [
        'total_events' => $total_events, 
        'total_active_events'=>$total_active_events,
        
        'total_eventshows' => $total_eventshows, 
        'total_active_eventshows'=>$total_active_eventshows,
        'total_speakers'=>$total_speakers,
        ]);        
    }                         
}
