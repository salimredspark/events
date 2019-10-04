<?php

namespace backend\controllers;

use Yii;
use backend\models\Events;
use backend\models\EventShow;
use backend\models\EventShowSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* EventShowController implements the CRUD actions for EventShow model.
*/
class EventShowController extends Controller
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

    public function actionSearchEvent(){
        $model = new EventShow();
                
        //search event show
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post()['EventShow'];
            #$eventsAll = Events::find(['id', $post['event_id']])->all();
            
            $searchModel = new EventShowSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->query->andWhere('event_id = '.$post['event_id']);
            
            $event_name = Events::findOne($post['event_id'])->event_name;
            
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


    /**
    * Lists all EventShow models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new EventShowSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single EventShow model.
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
    * Creates a new EventShow model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new EventShow();

        if ($model->load(Yii::$app->request->post())) {
            
            $eventsPost = Yii::$app->request->post('EventShow');
                        
            $updated_by = Yii::$app->user->identity->id;  
            $start_time = date("Y-m-d h:i:s",strtotime($eventsPost['start_time']));                        
            $end_time = date("Y-m-d h:i:s",strtotime($eventsPost['end_time']));
                        
            $model->start_time = $start_time;
            $model->end_time = $end_time;
            $model->updated_by = $updated_by;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
    * Updates an existing EventShow model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
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
            
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing EventShow model.
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
    * Finds the EventShow model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return EventShow the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = EventShow::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
