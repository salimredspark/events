<?php

namespace api\modules\event\controllers;
    
use yii\rest\ActiveController;
use yii\web\Response;
use yii;

/**
 * Country Controller API
 *
 * @author Budi Irawan <deerawan@gmail.com>
 */
 
class EventController extends ActiveController
{
    public $modelClass = 'api\modules\event\models\User';
    
    /*
        function : Login 
        Date : 23Oct2019
        Added By: Nirali
    */
    
    public function actionLogin()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $device_type = $_POST['device_type'];
        $device_token = $_POST['device_token'];
      
        if(trim($username)=='' || trim($password)==''){
            echo json_encode(array('status'=>0,'message'=>"Please enter username or password"),JSON_PRETTY_PRINT);die;
        }
        
        $model = new $this->modelClass;
        $userType = array('superadmin','admin');
        $user = $model->find()->where(['username' => $username])->andWhere(['not in','login_type',$userType])->one();
        
        if(empty($user)){
            echo json_encode(array('status'=>0,'message'=>"Wrong username or password"),JSON_PRETTY_PRINT);die;
        }
        $isPass = $model->validatePassword($password,$user->password_hash);
        
        $user->device_type = $device_type;
        $user->device_token = $device_token;
        
        if(!$user->save()){
            echo '<pre>'; print_r($user->errors);die; 
        }
        $user->save(false);
        
        $data=array();
        $row =array();
        $row = $user->attributes;
        
        $data = array(
            'id'=> $row['id'],
            'firstname'=> $row['firstname'],
            'lastname'=> $row['lastname'],
            'email'=> $row['email'],
            'login_type'=> $row['login_type'],
            'device_type'=> $row['device_type'],
            'device_token'=> $row['device_token'],
          );
                
        $post = Yii::$app->request->post();
        
        if($isPass){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
        }else{
            echo json_encode(array('status'=>0,'message'=>"Wrong username or password"),JSON_PRETTY_PRINT);
        }
        
        die;
    }
  
    
   protected function findModel($id)
    {
        $model=new $this->modelClass;
        if (($model = $model->findOne($id)) !== null) {
            return $model;
        } else {
            return new $this->modelClass;
            //throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}


