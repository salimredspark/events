<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

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
        return $this->render('dashboard');        
    }                         
}
