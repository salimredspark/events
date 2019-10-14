<?php

namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\Visitors;
use backend\models\VisitorsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
* VisitorsController implements the CRUD actions for Visitors model.
*/
class VisitorsController extends Controller
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
    * Lists all Visitors models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new VisitorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single Visitors model.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionView($id)
    {
        $one = $this->findModel($id);
                
        return $this->render('view', [
        'model' => $this->findModel($id),                
        ]);
    }

    /**
    * Creates a new Visitors model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new Visitors();
        $userModel = new User;
        
        if ($model->load(Yii::$app->request->post())) {

             $updated_by = Yii::$app->user->identity->id;
                         
            //save user
            $postUser = Yii::$app->request->post('User');
            $userModel->load(Yii::$app->request->post());            
            $userModel->password_hash = password_hash($postUser['password_hash'], PASSWORD_DEFAULT);
            $userModel->updated_at = date("Y-m-d H:i:s");
            $userModel->created_at = date("Y-m-d H:i:s");
            $userModel->updated_by = $updated_by;
            $userModel->login_type = 'visitor'; //'superadmin','admin','exhibitor','visitor'
            $userModel->save();   
            $last_insert_userid = $userModel->id; 
                        
            //save Visitors
            $post = Yii::$app->request->post('Visitors');                                                              
            $model->user_id = $last_insert_userid;
            $model->birthdate = date("Y-m-d", strtotime($post['birthdate']));            
            $model->created_at = date("Y-m-d H:i:s");
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = $updated_by;
            $model->save(); 
                        
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
        'model' => $model,
        'userModel' => $userModel,
        ]);
    }

    /**
    * Updates an existing Visitors model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);        
        $userModel = User::find()->where('id = '.$model->user_id)->one();
        
        if ($model->load(Yii::$app->request->post())) {

            $updated_by = Yii::$app->user->identity->id;
            
            //save User
            $old_password = $userModel->password_hash;
            $postUser = Yii::$app->request->post('User');
            $userModel->load(Yii::$app->request->post());
            if (empty($postUser['password_hash'])) {                
                $userModel->password_hash = $old_password;
            }else{
                $userModel->password_hash = password_hash($postUser['password_hash'], PASSWORD_DEFAULT); 
            }            
            $userModel->updated_at = date("Y-m-d H:i:s");
            $userModel->updated_by = $updated_by;
            $userModel->save();
            
            //save Exhibitors
            $post = Yii::$app->request->post('Visitors');            
            $model->birthdate = date("Y-m-d", strtotime($post['birthdate']));
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = $updated_by;
            $model->save();                        

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        'userModel' => $userModel,
        ]);
    }

    /**
    * Deletes an existing Visitors model.
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
    * Finds the Visitors model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return Visitors the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = Visitors::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
