<?php
   public function actionSignup(){
        
        $user_type = 'freelancer';
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $country_code = $_POST['mobile_country_code'];
        $mobile_number = $_POST['mobile_number'];
        $device_type = $_POST['device_type'];
        $device_token = $_POST['device_token'];
        
        if($password != $confirm_password){
            echo json_encode(array('status'=>0,'message'=>"Passwords don't match."),JSON_PRETTY_PRINT);die;
        }
        
        $model = new $this->modelClass;
        
        $exists_mo = $model->find()->select(['mobile_number'])->where(['mobile_number'=>$mobile_number])->exists();
        if($exists_mo){
            echo json_encode(array('status'=>0,'message'=>"Mobile number is already exist!"),JSON_PRETTY_PRINT);die;
        }
        
        
        $exists = $model->find()->select(['email'])->where(['email'=>$email])->exists();
        if($exists){
            echo json_encode(array('status'=>0,'message'=>"Email is already exist!"),JSON_PRETTY_PRINT);die;
        }
       
        
       
        $string = '0123456789';
        $string_shuffled = str_shuffle($string);
        $otpnumber = substr($string_shuffled, 1, 6);
            
        $model->user_type = $user_type;
        /*$model->first_name = $first_name;
        $model->last_name = $last_name;*/
        $model->email = $otpnumber;
        $model->username = $otpnumber;
        /*$model->mobile_number = $mobile_number;
        $user->country_code = $country_code;*/
        $model->mobile_flag = 2;
        $model->status = 0;
        $model->admin_status = 0;
        /*$model->setPassword($password);
        $model->generateAuthKey();
        $model->device_type= $device_type;
        $model->device_token= $device_token;*/
        $model->save(false);
        
        $user = $model->find()->where(['id' => $model->id])->one();
        $user->otp = $otpnumber;
        $user->save(false);
    
        $mobile_number = $mobile_number;
        $country_code = $country_code;
        $phoneNumber = str_replace('+','',$country_code.$mobile_number);

        $text = 'Your HausBuddy verification code is: '.$otpnumber;                    
        
        $url = 'https://apps.mnotify.net/smsapi?key=a2f660731c8ef4af3103&to='.$phoneNumber.'&msg='.urlencode($text).'&sender_id=HausBuddy';
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
        ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
            
        if(true){
                    
            $row =array();
            $data =array();
            $row = $model->attributes;
            
                $avg_ratings = 0;
                if(!empty($row['avg_ratings'])){
                    $avg_ratings = $row['avg_ratings'];
                }
                
                $profile_pic = '';
                if(!empty($row['profile_pic'])){
                    $profile_pic = Yii::getAlias('@profilePic/').$row['profile_pic'];
                }else{
                    $profile_pic = Yii::getAlias('@profilePic/').'default_profile.png';
                }
                
                $banner = '';
                if(!empty($row['banner_image'])){
                    $banner = Yii::getAlias('@bannerPath/').$row['banner_image'];
                }else{
                    $banner = Yii::getAlias('@profilePic/').'banner-placeholder.jpg';
                }
                
                $piece_rate='';
                if(!empty($row['piece_rate'])){
                    $piece_rate = $row['piece_rate'];
                }
                
                $country_code='';
                if(!empty($row['country_code'])){
                    $country_code = $row['country_code'];
                }
                /*$gender='';
                if(!empty($row['gender'])){
                    $gender = $row['gender'];
                }
                $birth_day='';
                if(!empty($row['birth_day'])){
                    $birth_day = $row['birth_day'];
                }
                $birth_month='';
                if(!empty($row['birth_month'])){
                    $birth_month = $row['birth_month'];
                }*/
                
                if($row['device_token'] == NULL){$device_token = '';}else{ $device_token = $row['device_token'];}
                if($row['device_type'] == NULL){$device_type = '';}else{ $device_type = $row['device_type'];}
                
                $data = array(
                    'id'=> $row['id'],
                    //'profile_pic'=> $profile_pic,
                    //'banner_image'=> $banner, 
                    //'first_name'=> $row['first_name'], 
                    //'last_name'=> $row['last_name'], 
                    'email'=> $row['email'], 
                    'piece_rate'=> $piece_rate, 
                    //'mobile_country_code'=> $country_code, 
                    //'mobile_number'=> $row['mobile_number'], 
                    'mobile_flag'=>$row['mobile_flag'],
                    //'device_token'=>$device_token,
                    //'device_type'=>$device_type,
                    'otp'=>$otpnumber,
                    //'gender'=> $gender, 
                    //'birth_day'=> $birth_day, 
                    //'birth_month'=> $birth_month, 
                    //'birth_year'=> $row['birth_year'], 
                    //'country'=> $row['country'], 
                    //'city'=> $row['city'], 
                    //'location_address'=> $row['location_address'], 
                   // 'latitude'=> $row['latitude'], 
                   // 'longitude'=> $row['longitude'], 
                   // 'id_proof'=> Yii::getAlias('@idProofPath/').$row['id_proof'], 
                   // 'address_proof'=> Yii::getAlias('@address_proofPath/').$row['address_proof'], 
                   // 'radius'=> $row['radius'], 
                    //'total_experience'=> $row['total_experience'], 
                );
                
            echo json_encode(array('status'=>1,'message'=>"Success",'data'=>$data),JSON_PRETTY_PRINT);
        }else{
            echo json_encode(array('status'=>0,'message'=>"Failure"),JSON_PRETTY_PRINT);
        }
    }
    
   public function actionVerifyotp(){
           
            $user_type = 'freelancer';
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
            $country_code = $_POST['mobile_country_code'];
            $mobile_number = $_POST['mobile_number'];
            $device_type = $_POST['device_type'];
            $device_token = $_POST['device_token'];
        
            $otp = $_POST['otp'];
            $user_id = $_POST['user_id'];
            
            $modelFreelancer = new $this->modelFreelancer();
            $otpDb = $modelFreelancer->find()->select(['otp'])->where(['id'=>$user_id])->one()->otp;
            if($otpDb == $otp){
                
                //echo json_encode(array('status'=>1,'message'=>'Success','data'=>$datadad),JSON_PRETTY_PRINT);die;
                
                /*$user = $model->find()->where(['id'=>$user_id])->one();
                $user->status = 10;
                $user->mobile_flag = 1;
                $user->save(false);*/
               
                $model = new $this->modelClass;
                $user = $model->find()->where(['id'=>$user_id])->one();
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->email = $email;
                $user->username = $email;
                $user->mobile_number = $mobile_number;
                $user->country_code = $country_code;
                $user->mobile_flag = 1;
                $user->status = 10;
                $user->otp_verified = 1;
                $user->coins = 5;
                $user->setPassword($password);
                $user->generateAuthKey();
                $user->device_type= $device_type;
                $user->device_token= $device_token;
                $user->save(false);
                
                
                $this->ThankYouEmail($email,$first_name,$last_name);
                 
                Yii::$app->user->login($user);
                 
                $data=array();
                $row =array();
                $row = $user->attributes;
        
                $avg_ratings = 0;
                if(!empty($row['avg_ratings'])){
                    $avg_ratings = $row['avg_ratings'];
                }
                $profile_pic = '';
                if(!empty($row['profile_pic'])){
                    $profile_pic = Yii::getAlias('@profilePic/').$row['profile_pic'];
                }else{
                    $profile_pic = Yii::getAlias('@profilePic/').'default_profile.png';
                }
                
                $banner = '';
                if(!empty($row['banner_image'])){
                    $banner = Yii::getAlias('@bannerPath/').$row['banner_image'];
                }else{
                    $banner = Yii::getAlias('@profilePic/').'banner-placeholder.jpg';
                }
                
                $id_proof = '';
                if(!empty($row['id_proof'])){
                    $id_proof = Yii::getAlias('@idProofPath/').$row['id_proof'];
                }
                
                $address_proof = '';
                if(!empty($row['address_proof'])){
                    $address_proof = Yii::getAlias('@address_proofPath/').$row['address_proof'];
                }
                
                $piece_rate='';
                if(!empty($row['piece_rate'])){
                    $piece_rate = $row['piece_rate'];
                }
                
                $country_code='';
                if(!empty($row['country_code'])){
                    $country_code = $row['country_code'];
                }
                $gender='';
                if(!empty($row['gender'])){
                    $gender = $row['gender'];
                }
                $birth_day='';
                if(!empty($row['birth_day'])){
                    $birth_day = $row['birth_day'];
                }
                $birth_month='';
                if(!empty($row['birth_month'])){
                    $birth_month = $row['birth_month'];
                }
                
                if($row['radius'] == NULL){$radius = '';}else{ $radius = $row['radius'];}
                if($row['total_experience'] == NULL){$total_experience = '';}else{ $total_experience = $row['total_experience'];}
                if($row['device_token'] == NULL){$device_token = '';}else{ $device_token = $row['device_token'];}
                if($row['device_type'] == NULL){$device_type = '';}else{ $device_type = $row['device_type'];}
                
                $data = array(
                    'id'=> $row['id'],
                    'profile_pic'=> $profile_pic,
                    'banner_image'=> $banner, 
                    'first_name'=> $row['first_name'], 
                    'last_name'=> $row['last_name'], 
                    'email'=> $row['email'], 
                    'piece_rate'=> $piece_rate, 
                    'mobile_country_code'=> $country_code, 
                    'mobile_number'=> $row['mobile_number'], 
                    'mobile_flag'=>$row['mobile_flag'],
                    'device_token'=>$device_token,
                    'device_type'=>$device_type,
                    'gender'=> $gender, 
                    'birth_day'=> $birth_day, 
                    'birth_month'=> $birth_month, 
                    'birth_year'=> $row['birth_year'], 
                    'country'=> $row['country'], 
                    'city'=> $row['city'], 
                    'location_address'=> $row['location_address'], 
                    'latitude'=> $row['latitude'], 
                    'longitude'=> $row['longitude'], 
                    'id_proof'=> $id_proof, 
                    'address_proof'=> $address_proof, 
                    'radius'=> $radius, 
                    'total_experience'=> $total_experience, 
                    'otp'=> $row['otp'], 
                );
                    echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
                }else{
                    echo json_encode(array('status'=>0,'message'=>'Your otp is wrong.','data'=>$data),JSON_PRETTY_PRINT);
                }
            
            
    }
    
   public function actionResendotp(){
        
            $country_code = $_POST['mobile_country_code'];
            $mobile_number = $_POST['mobile_number'];
            
            $phoneNumber = str_replace('+','',$country_code.$mobile_number);
            
           // $otp = $_POST['otp'];
            $user_id = $_POST['user_id'];
            
            $string = '0123456789';
            $string_shuffled = str_shuffle($string);
            $otpnumber = substr($string_shuffled, 1, 6);

            $model = new $this->modelClass;
            $user = $model->find()->where(['id' => $user_id])->one();
            $user->otp = $otpnumber;
            $user->save(false);
            
            $text = 'Your HausBuddy verification code is: '.$otpnumber; 
            
            $url = 'https://apps.mnotify.net/smsapi?key=a2f660731c8ef4af3103&to='.$phoneNumber.'&msg='.urlencode($text).'&sender_id=HausBuddy';
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
            ),
            ));
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
           
            if($response == 1000){
                echo json_encode(array('status'=>1,'message'=>'Success'),JSON_PRETTY_PRINT);
            }else{
                echo json_encode(array('status'=>0,'message'=>'Failure'),JSON_PRETTY_PRINT);
            }
    }
    
   public function actionSocialLogin(){
       
       $first_name = $_POST['first_name'];
       $user_type = 'freelancer';
       $last_name = $_POST['last_name'];
       $email = $_POST['email'];
       $device_type = $_POST['device_type'];
       $device_token = $_POST['device_token'];
       
       $model = new $this->modelClass;
       $user = $model->find()->where(['email' => $email])->one();
       
       if(!empty($user)){
            /*$user->first_name = $first_name;
            $user->last_name = $last_name;*/
            $user->device_type= $device_type;
            $user->device_token= $device_token;
            $user->save(false);
            
            Yii::$app->user->login($model);
            $row =array();
              $data =array();
              $row = $user->attributes;
            
                $avg_ratings = 0;
                if(!empty($row['avg_ratings'])){
                    $avg_ratings = $row['avg_ratings'];
                }
                $profile_pic = '';
                if(!empty($row['profile_pic'])){
                    $profile_pic = Yii::getAlias('@profilePic/').$row['profile_pic'];
                }
                
                $banner = '';
                if(!empty($row['banner_image'])){
                    $banner = Yii::getAlias('@bannerPath/').$row['banner_image'];
                }
                
                $id_proof = '';
                if(!empty($row['id_proof'])){
                    $id_proof = Yii::getAlias('@idProofPath/').$row['id_proof'];
                }
                
                $address_proof = '';
                if(!empty($row['address_proof'])){
                    $address_proof = Yii::getAlias('@address_proofPath/').$row['address_proof'];
                }
                
                $piece_rate='';
                if(!empty($row['piece_rate'])){
                    $piece_rate = $row['piece_rate'];
                }
                
                $country_code='';
                if(!empty($row['country_code'])){
                    $country_code = $row['country_code'];
                }
                $gender='';
                if(!empty($row['gender'])){
                    $gender = $row['gender'];
                }
                $birth_day='';
                if(!empty($row['birth_day'])){
                    $birth_day = $row['birth_day'];
                }
                $birth_month='';
                if(!empty($row['birth_month'])){
                    $birth_month = $row['birth_month'];
                }
                
                if($row['radius'] == NULL){$radius = '';}else{ $radius = $row['radius'];}
                if($row['total_experience'] == NULL){$total_experience = '';}else{ $total_experience = $row['total_experience'];}
                if($row['device_token'] == NULL){$device_token = '';}else{ $device_token = $row['device_token'];}
                if($row['device_type'] == NULL){$device_type = '';}else{ $device_type = $row['device_type'];}
                
                $data = array(
                    'id'=> $row['id'],
                    'profile_pic'=> $profile_pic,
                    'banner_image'=> $banner, 
                    'first_name'=> $row['first_name'], 
                    'last_name'=> $row['last_name'], 
                    'email'=> $row['email'], 
                    'piece_rate'=> $piece_rate, 
                    'mobile_country_code'=> $country_code, 
                    'mobile_number'=> $row['mobile_number'], 
                    'mobile_flag'=>$row['mobile_flag'],
                    'device_token'=>$device_token,
                    'device_type'=>$device_type,
                    'gender'=> $gender, 
                    'birth_day'=> $birth_day, 
                    'birth_month'=> $birth_month, 
                    'birth_year'=> $row['birth_year'], 
                    'country'=> $row['country'], 
                    'city'=> $row['city'], 
                    'location_address'=> $row['location_address'], 
                    'latitude'=> $row['latitude'], 
                    'longitude'=> $row['longitude'], 
                    'id_proof'=> $id_proof, 
                    'address_proof'=> $address_proof, 
                    'radius'=> $radius, 
                    'total_experience'=> $total_experience, 
                    'coins'=> $row['coins'],
                );
             
            echo json_encode(array('status'=>1,'message'=>"Success",'data'=>$data),JSON_PRETTY_PRINT);
             
        }else{
            
            $model = new $this->modelClass;
           
            $model->setAttribute('first_name',$first_name);
            $model->setAttribute('last_name',$last_name);
            $model->setAttribute('email',$email);
            $model->setAttribute('username',$email);
            $model->setAttribute('status',10);
            $model->setAttribute('coins',5);
            $model->setAttribute('user_type',$user_type);
            $model->setAttribute('otp_verified',1);
            $model->setAttribute('admin_status',0);
            $model->setAttribute('device_token',$device_token);
            $model->setAttribute('device_type',$device_type);
            $model->setAttribute('auth_key','');
            $model->setAttribute('password_hash','');
            $model->setAttribute('country_code','+93');
            $model->setAttribute('mobile_number','0666444222');
            $model->setAttribute('created_at',date('Y-m-d h:i:s'));
            $model->setAttribute('updated_at',date('Y-m-d h:i:s'));
            
            if($model->save()){
                
                $this->ThankYouEmail($model->email,$model->first_name,$model->last_name);
              $row =array();
              $data =array();
              $row = $model->attributes;
            
                $avg_ratings = 0;
                if(!empty($row['avg_ratings'])){
                    $avg_ratings = $row['avg_ratings'];
                }
                $profile_pic = '';
                if(!empty($row['profile_pic'])){
                    $profile_pic = Yii::getAlias('@profilePic/').$row['profile_pic'];
                }
                
                $banner = '';
                if(!empty($row['banner_image'])){
                    $banner = Yii::getAlias('@bannerPath/').$row['banner_image'];
                }
                $piece_rate='';
                if(!empty($row['piece_rate'])){
                    $piece_rate = $row['piece_rate'];
                }
                
                $country_code='';
                if(!empty($row['country_code'])){
                    $country_code = $row['country_code'];
                }
                $mobile_number='';
                if(!empty($row['mobile_number'])){
                    $mobile_number = $row['mobile_number'];
                }
                
                if($row['device_token'] == NULL){$device_token = '';}else{ $device_token = $row['device_token'];}
                if($row['device_type'] == NULL){$device_type = '';}else{ $device_type = $row['device_type'];}
                
                $data = array(
                    'id'=> $row['id'],
                    'first_name'=> $row['first_name'], 
                    'last_name'=> $row['last_name'], 
                    'email'=> $row['email'], 
                    'piece_rate'=> $piece_rate, 
                    'mobile_country_code'=> $country_code, 
                    'mobile_number'=> $mobile_number, 
                    'mobile_flag'=>1,
                    'device_token'=>$device_token,
                    'device_type'=>$device_type,
                    'coins'=> $row['coins'],
                   
                );
                 echo json_encode(array('status'=>1,'message'=>"Success",'data'=>$data),JSON_PRETTY_PRINT);
            }
        }
    }
    
    
   public function actionResetPassword(){
        $email = $_POST['email'];
        
        $model = new $this->modelClass;
        
        $user = $model->findOne([
            'email' =>$email,
        ]);

       if(empty($user)){
            echo json_encode(array('status'=>0,'message'=>"This email is not registered."),JSON_PRETTY_PRINT);
            die;
        }
        
        if (!$model->isPasswordResetTokenValid($user->password_reset_token)){
            $user->generatePasswordResetToken();
        }
        
        if (!$user->save()) {
            echo json_encode(array('status'=>0,'message'=>"This email is not registered."),JSON_PRETTY_PRINT);
            die;
        }

         Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $user]
            )
            ->setFrom(["support@hausbuddy.com" => "HausBuddy"])
            ->setTo($email)
            ->setSubject('Password reset for HausBuddy')
            ->send();
         
         echo json_encode(array('status'=>1,'message'=>"Email has been sent successfully"),JSON_PRETTY_PRINT);die;
    }
    
   private function ThankYouEmail($email,$first_name,$last_name){
        
         // $logo=  Yii::$app->params['email_images'].'logo.png';
        
         $logo=  (( isset($_SERVER['HTTPS'] ) )?'https':'http').'://hausbuddy.com/email_images/logo/logo.png';
         $loginlink= (( isset($_SERVER['HTTPS'] ) )?'https':'http').'://hausbuddy.com/';
    
        $message ='';
        $message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="format-detection" content="date=no" />
<meta name="format-detection" content="address=no" />
<meta name="format-detection" content="telephone=no" />
<title></title>
<link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet"> 
<style type="text/css">
body {
    margin: 0px !important;
    padding: 0px !important;
    -webkit-text-size-adjust: 100% !important;
    -ms-text-size-adjust: 100% !important;
    -webkit-font-smoothing: antialiased !important;
}
html {
    width: 100%;
}
img {
    border: 0 !important;
    outline: none !important;
    display: block !important;
}
table {
    border-collapse: collapse;
    mso-table-lspace: 0px;
    mso-table-rspace: 0px;
}
td {
    border-collapse: collapse;
    mso-line-height-rule: exactly;
}
a, span {
    mso-line-height-rule: exactly;
}
a {
    text-decoration: none !important;
}
.ExternalClass * {
    line-height: 100%;
}
.video img {
    width: 100%;
    height: auto;
}
h1, h2, h3, h4, h5, h6 {
    line-height: 100% !important;
    -webkit-font-smoothing: antialiased;
}
yshortcuts, .yshortcuts a, .yshortcuts a:link, .yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
    color: black;
    text-decoration: none !important;
    border-bottom: none !important;
    background: none !important;
}
code {
    white-space: 300;
    word-break: break-all;
}
span a {
    text-decoration: none !important;
}
.yshortcuts a {
    border-bottom: none !important;
}
*[class="gmail-fix"] {
    display: none !important;
}
 @media only screen and (min-width:481px) and (max-width:599px) {
table[class=templetcontainer] {
    width: 100% !important;
}
table[class=spark_full_width_containt] {
    width: 100% !important;
}
td[class=spacer] {
    padding-left: 14px !important;
    padding-right: 14px !important;
}
td[class=remove] {
    display: none !important;
}
img[class=full_img] {
    width: 100% !important;
    height: auto !important;
}
td[class=height_f] {
    height: 20px !important;
}
td[class=video] img {
    width: 100% !important;
    height: auto !important;
}
td[class=text_center] {
    text-align: center !important;
}
.hide {
    display: none !important;
}
td[class="mob_hide"] {
    display: none !important;
    font-size: 0 !important;
    height: 0 !important;
    line-height: 0 !important;
    min-height: 0 !important;
    width: 0 !important;
}
td[class="templetcontainer2"] {
    float: left !important;
    width: 100% !important;
    display: block !important;
}
td[class=pad_bottom] {
    padding-bottom: 10px;
}
td[class=pad_top] {
    padding-top: 10px;
}
iframe {
    width: 100% !important;
    height: auto !important;
}
}
 @media only screen and (max-width:480px) {
table[class=templetcontainer] {
    width: 100% !important;
}
table[class=spark_full_width_containt] {
    width: 100% !important;
}
td[class="spacer"] {
    padding-left: 16px !important;
    padding-right: 16px !important;
}
td[class=remove] {
    display: none !important;
}
img[class=full_img] {
    width: 100% !important;
    height: auto !important;
}
td[class=height_f] {
    height: 20px !important;
}
td[class=video] img {
    width: 100% !important;
    height: auto !important;
}
td[class=text_center] {
    text-align: center !important;
}
.hide {
    display: none !important;
}
td[class=pad_bottom] {
    padding-bottom: 10px;
}
td[class=pad_top] {
    padding-top: 10px;
}
td[class="mob_hide"] {
    display: none !important;
    font-size: 0 !important;
    height: 0 !important;
    line-height: 0 !important;
    min-height: 0 !important;
    width: 0 !important;
}
td[class="templetcontainer2"] {
    float: left !important;
    width: 100% !important;
    display: block !important;
}
table[class="center_align"] {
    float: none !important;
    margin: 0 auto !important;
    display: block !important;
    width: 165px !important;
}
iframe {
    width: 100% !important;
    height: auto !important;
}
}



/* Hide spacer image in applications that support media queries */
@media only screen and (max-width: 600px) {
*[class="gmail-fix"] {
    display: none !important;
}
}
</style>
</head>
<body marginwidth="0" marginheight="0" offset="0" topmargin="0" leftmargin="0" bgcolor="#d7dde5">
<table width="100%" border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="#d7dde5">
  <tr class="gmail-fix">
    <td><table cellpadding="0" cellspacing="0" border="0" align="center" width="600">
        <tr>
          <td cellpadding="0" cellspacing="0" border="0" height="1"; style="line-height: 1px; min-width: 600px; mso-line-height-rule: exactly;"><img src="images/spacer.gif" width="600" height="1" style="display: block; max-height: 1px; min-height: 1px; min-width: 600px; width: 600px; "/></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
  </tr>
  <tr>
    <td class="spacer" align="center"><table class="templetcontainer" style="table-layout:fixed; background-color:#e7e7e7;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#e7e7e7">
        <tr>
          <td align="center"><table class="templetcontainer" style="table-layout:fixed; background-color:#ffffff;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#ffffff">
              <tr>
                <td class="height_f" height="30">&nbsp;</td>
              </tr>
              <tr>
                <td align="center"><table class="templetcontainer" align="center" cellspacing="0" cellpadding="0" width="600" border="0">
                    <tr>
                      <td class="remove" width="20">&nbsp;</td>
                      <td align="center"><a href="#" target="_blank"><img src="'.$logo.'" alt="Haus Buddy" style="display:block; max-width:260px;" width="260" height="49" border="0"></a></td>
                      <td class="remove" width="20">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td class="height_f" height="30">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="spacer" align="center"><table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class="templetcontainer" bgcolor="#ffffff" style="table-layout:fixed; background-color:#ffffff;" >
        <tr>
          <td width="20" class="remove">&nbsp;</td>
          <td width="" class="spacer"><table width="560" border="0" cellspacing="0" cellpadding="0" align="center" class="templetcontainer">
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="font-size:14px; line-height:15px; font-family:"Roboto", Arial, Helvetica, sans-serif; color:#1a1a1a; font-weight:500; text-align: left; padding:0;">Hey Buddy!</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              
              <tr>
                <td align="left" style="font-size:14px; line-height:15px; font-family:   "Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">Welcome to HausBuddy! We are truly grateful that you decided to take your time and become part of our HausBuddyz family.</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="font-size:14px; line-height:15px; font-family:   "Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">We are very excited to work with you and hopefully give you something of value in return! We started HausBuddy years ago with a single goal of elevating service quality. For Service seekers, we provide a faster and an easier way to outsource various tasks around the home and office. For the Service professional, an avenue to work and earn an income.</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
               <tr>
                <td align="left" style="font-size:14px; line-height:15px; font-family:"Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">Thanks again and I want you to know that I am always open to hearing your ideas on building a better and stronger community.<a href="'.$loginlink.'">Click here</a> to log in</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
              <tr>
                <td align="left" style="font-size:14px; line-height:24px; font-family: "Roboto", Arial, Helvetica, sans-serif; color:#5a5a5a;; font-weight:400; text-align: left; padding:0px 0;">Thank you, <br> Team HausBuddy.</td>
              </tr>
              <tr>
                <td height="10" class="height_f">&nbsp;</td>
              </tr>
            </table></td>
          <td width="20" class="remove">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td align="center" class="spacer"><table class="templetcontainer" style="table-layout:fixed; background-color:#ffffff;" align="center" cellspacing="0" cellpadding="0" width="600" border="0" bgcolor="#ffffff">
        <tr>
          <td class="remove" width="20">&nbsp;</td>
          <td class="spacer" align="center" valign="top"><table class="templetcontainer" align="center" cellspacing="0" cellpadding="0" width="560" border="0">
              <tr>
                <td height="10">&nbsp;</td>
              </tr>
              
              <tr>
                <td height="20"></td>
              </tr>
            </table></td>
          <td class="remove" width="20">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="10">&nbsp;</td>
  </tr>
</table>
</body>
</html>';
        
        $email = Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom(["support@hausbuddy.com" => "HausBuddy"])
            ->setSubject('Welcome to HausBuddy.')
            ->setHtmlBody($message)->send(); 
    }
?>
