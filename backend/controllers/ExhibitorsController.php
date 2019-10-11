<?php

namespace backend\controllers;

use Yii;
use backend\models\Exhibitors;
use backend\models\ExhibitorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* ExhibitorsController implements the CRUD actions for Exhibitors model.
*/
class ExhibitorsController extends Controller
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
    * Lists all Exhibitors models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new ExhibitorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Exhibitors model.
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
    * Creates a new Exhibitors model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Exhibitors();

        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post('Exhibitors');                        
            $updated_by = Yii::$app->user->identity->id;
                          
            $model->password_has = password_hash($post['password_has'], PASSWORD_DEFAULT);
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = $updated_by;
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
        'model' => $model,
        ]);
    }

    /**
    * Updates an existing Exhibitors model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_password = $model->password_has;
                
        if ($model->load(Yii::$app->request->post())) {

            $post = Yii::$app->request->post('Exhibitors');            

            $updated_by = Yii::$app->user->identity->id;            
            if (empty($post['password_has'])) {                
                $model->password_has = $old_password;
            }else{
                $model->password_has = password_hash($post['password_has'], PASSWORD_DEFAULT); 
            }
            
            $model->birthdate = date("Y-m-d", strtotime($post['birthdate']));
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = $updated_by;
            $model->save();

            /*
            when login use
            if (password_verify($request->password, $post['password_has'])) {
            // Success
            }
            */

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing Exhibitors model.
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
    * Finds the Exhibitors model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Exhibitors the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Exhibitors::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
