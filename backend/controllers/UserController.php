<?php
namespace backend\controllers;

use Yii;
use backend\models\User;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

class UserController extends Controller
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
    * Lists all User models.
    * @return mixed
    */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        //get only admin or superadmin users
        $dataProvider->query->andWhere('login_type in ("superadmin","admin")');
        
        return $this->render('index', [
        'searchModel' => $searchModel,
        'dataProvider' => $dataProvider,
        ]);
    }

    /**
    * Displays a single User model.
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
    * Creates a new User model.
    * If creation is successful, the browser will be redirected to the 'view' page.
    * @return mixed
    */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {

            $updated_by = Yii::$app->user->identity->id;  

             //upload profile image
            $uploadObjProfileImg = UploadedFile::getInstance($model, 'profile_image');                        
            if($uploadObjProfileImg){
                $filename = md5(time().rand(1111,9999)).'.'.$uploadObjProfileImg->extension;
                $uploadpath = 'users/'.$filename;
                $uploadObjProfileImg->saveAs('../../uploads/'.$uploadpath);
                $model->profile_image = $uploadpath;
            }
            
            $model->created_at = date("Y-m-d H:i:s");
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
    * Updates an existing User model.
    * If update is successful, the browser will be redirected to the 'view' page.
    * @param integer $id
    * @return mixed
    * @throws NotFoundHttpException if the model cannot be found
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $updated_by = Yii::$app->user->identity->id;  

            $old_password = $model->password_hash;
            $postUser = Yii::$app->request->post('User');            
            if (empty($postUser['password_hash'])) {                
                $model->password_hash = $old_password;
            }else{
                $model->password_hash = password_hash($postUser['password_hash'], PASSWORD_DEFAULT); 
            }                        

             //upload profile image
            $uploadObjProfileImg = UploadedFile::getInstance($model, 'profile_image');                        
            if($uploadObjProfileImg){
                $filename = md5(time().rand(1111,9999)).'.'.$uploadObjProfileImg->extension;
                $uploadpath = 'users/'.$filename;
                $uploadObjProfileImg->saveAs('../../uploads/'.$uploadpath);
                $model->profile_image = $uploadpath;
            }
            
            $model->updated_at = date("Y-m-d H:i:s");
            $model->updated_by = $updated_by;
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
        'model' => $model,
        ]);
    }

    /**
    * Deletes an existing User model.
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
    * Finds the User model based on its primary key value.
    * If the model is not found, a 404 HTTP exception will be thrown.
    * @param integer $id
    * @return User the loaded model
    * @throws NotFoundHttpException if the model cannot be found
    */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
