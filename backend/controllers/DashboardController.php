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
use backend\models\Hotels;
use backend\models\Exhibitors;
use backend\models\Visitors;

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
        $total_todays_active_events = Events::find()->where([ '>=', 'end_time', $today])->count();

        //get on active events list
        $active_events = Events::find()->where('(end_time >= NOW() AND start_time <= NOW()) AND DATE(start_time) = CURDATE()')->limit(10)->offset(0)->orderBy(['start_time' => SORT_ASC])->all();

        //today events list
        $todays_events = Events::find()->where('start_time >= NOW() AND DATE(start_time) = CURDATE()')->limit(10)->offset(0)->orderBy(['start_time' => SORT_ASC])->all();        

        //active but not todays events list
        $upcoming_events = Events::find()->where('start_time >= NOW() AND DATE(start_time) <> CURDATE()')->limit(10)->offset(0)->orderBy(['start_time'=>SORT_ASC])->all();

        //completed events list 
        $completed_events = Events::find()->where('end_time <= NOW()')->limit(10)->offset(0)->orderBy(['end_time'=>SORT_DESC])->all();
        
        //events Shows
        //$total_eventshows = EventShow::find()->count();        
        //$today = date('Y-m-d h:i:s');
        //$total_active_eventshows = EventShow::find()->where([ '>=', 'end_time', $today])->count();

        //get total speakers count
        $total_speakers = Speakers::find()->count();
                       
        //get exhibitors
        $total_exhibitors = Exhibitors::find()->count();
        $exhibitors_list = Exhibitors::find()
        ->joinWith('user', true, 'RIGHT JOIN')        
        ->groupBy(['id'])
        ->limit(10)->offset(0)->orderBy(['created_at'=>SORT_DESC])->all();
                
        //get visitors
        $total_visitors = Visitors::find()->count();
        $visitors_list = Visitors::find()
        ->joinWith('user', true, 'RIGHT JOIN')
        ->groupBy(['id'])
        ->limit(10)->offset(0)->orderBy(['created_at'=>SORT_DESC])->all();
        
        
        return $this->render('dashboard', [
        'total_events' => $total_events, 
        'total_todays_events'=>$total_todays_active_events,
        
        'active_events'=>$active_events,
        'todays_events'=>$todays_events,
        'upcoming_events'=>$upcoming_events,
        'completed_events'=>$completed_events,

        //'total_eventshows' => $total_eventshows, 
        //'total_active_eventshows'=>$total_active_eventshows,

        'total_speakers'=>$total_speakers,
                
        'total_exhibitors'=>$total_exhibitors,        
        'exhibitors_list'=>$exhibitors_list,
        
        'total_visitors'=>$total_visitors,
        'visitors_list'=>$visitors_list,
        ]);        
    }                         
}
