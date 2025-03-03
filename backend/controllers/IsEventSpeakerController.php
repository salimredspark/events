<?php

namespace backend\controllers;

use Yii;
use backend\models\Events;
use backend\models\IsEventSpeaker;
use backend\models\IsEventSpeakerSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* IsEventSpeakerController implements the CRUD actions for IsEventSpeaker model.
*/
class IsEventSpeakerController extends Controller
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
        $modelIsEventSpeaker = new IsEventSpeaker();
        $model = new IsEventSpeakerSearch();

        //search event show
        if(Yii::$app->request->post()){
            $post = Yii::$app->request->post()['IsEventSpeakerSearch'];
            if($post['event_id'] > 0){
                $searchModel = new IsEventSpeakerSearch();                                
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $dataProvider->query->andWhere('event_id = '.$post['event_id']);

                $event_name = Events::findOne($post['event_id'])->event_name;
                return $this->render('index', [
                'event_name'=> $event_name,             
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                ]);            
            }
        }

        return $this->render('search_event_speaker', [
        'model' => $model,
        'event_name' => ''
        ]);
    }

    /**
    * Lists all IsEventSpeaker models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new IsEventSpeakerSearch();
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

    /**
    * Displays a single IsEventSpeaker model.
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
    * Creates a new IsEventSpeaker model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new IsEventSpeaker();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
    * Updates an existing IsEventSpeaker model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing IsEventSpeaker model.
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
    * Finds the IsEventSpeaker model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return IsEventSpeaker the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = IsEventSpeaker::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
