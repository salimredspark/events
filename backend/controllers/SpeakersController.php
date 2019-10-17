<?php

namespace backend\controllers;

use Yii;
use backend\models\Speakers;
use backend\models\SpeakersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SpeakersController implements the CRUD actions for Speakers model.
 */
class SpeakersController extends Controller
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
        $searchModel = new SpeakersSearch();
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
        $model = new Speakers();

        if ($model->load(Yii::$app->request->post())) {
            
            $updated_by = Yii::$app->user->identity->id;  
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
        if (($model = Speakers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionGetSpeaker($id){
        if($id){
            $returnObj = $this->findModel($id);            
            $return['name'] = $returnObj->speaker_name;
            $return['speaker_role_id'] = $returnObj->speaker_role_id;
            $return['speaker_details'] = $returnObj->speaker_details;
           
            echo json_encode($return, true);
        }        
    }
}
