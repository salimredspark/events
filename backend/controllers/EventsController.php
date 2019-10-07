<?php

namespace backend\controllers;

use Yii;
use backend\models\Events;
use backend\models\EventsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Speakers;
use backend\models\SpeakerRole;

/**
 * EventsController implements the CRUD actions for Events model.
 */
class EventsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all Events models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Events model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Events model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Events();
        $modelSpeakers = new Speakers();
        $modelSpeakerRole = new SpeakerRole();

        if ($model->load(Yii::$app->request->post())) {
            
            $eventsPost = Yii::$app->request->post('Events'); 
            $updated_by = Yii::$app->user->identity->id;  
            
            #$model->start_time = strtotime(Yii::$app->request->post('start_time'));
            #$model->end_time = strtotime(Yii::$app->request->post('end_time'));
            
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

    /**
     * Updates an existing Events model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $eventsPost = Yii::$app->request->post('Events');
            $updated_by = Yii::$app->user->identity->id;  
                        
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

    /**
     * Deletes an existing Events model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Events model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Events the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Events::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
