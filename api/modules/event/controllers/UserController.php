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
 
class UserController extends ActiveController
{
   public $modelClass = 'api\modules\event\models\User';
   public $modelIsEventExhibitors = 'api\modules\event\models\IsEventExhibitors';
   public $modelSpeakers = 'api\modules\event\models\Speakers';
   public $modelVisitors = 'api\modules\event\models\Visitors';
   public $modelEventLocationSlots = 'api\modules\event\models\EventLocationSlots';
   public $modelEventType = 'api\modules\event\models\EventType';
   public $modelEventShow = 'api\modules\event\models\EventShow';
   public $modelGeneralVendor = 'api\modules\event\models\GeneralVendor';
   public $modelEventLocation = 'api\modules\event\models\EventLocation';
   public $modelSpeakerAccommodation = 'api\modules\event\models\SpeakerAccommodation';
   public $modelSettings = 'api\modules\event\models\Settings';
   public $modelSpeakerRole = 'api\modules\event\models\SpeakerRole';
   public $modelGeneralCategory = 'api\modules\event\models\GeneralCategory';
   public $modelExhibitors = 'api\modules\event\models\Exhibitors';
   public $modelEvents = 'api\modules\event\models\Events';
   public $modelIsEventSpeaker = 'api\modules\event\models\IsEventSpeaker';
   public $modelAttandees = 'api\modules\event\models\Attandees';
   public $modelEventLocationBooth = 'api\modules\event\models\EventLocationBooth';
   public $modelExhibitorMeetings = 'api\modules\event\models\ExhibitorMeetings';
   public $modelIsExhibitorMeetings = 'api\modules\event\models\IsExhibitorMeetings';
    
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
            echo json_encode(array('status'=>0,'message'=>"Please enter username or password",'data'=>array()),JSON_PRETTY_PRINT);die;
        }
        
        $model = new $this->modelClass;
        $userType = array('superadmin','admin');
        $user = $model->find()->where(['username' => $username])->andWhere(['not in','login_type',$userType])->one();
        
        if(empty($user)){
            echo json_encode(array('status'=>0,'message'=>"Wrong username or password",'data'=>array()),JSON_PRETTY_PRINT);die;
        }
        $isPass = $model->validatePassword($password,$user->password_hash);
        
        $user->device_type = $device_type;
        $user->device_token = $device_token;
        
        if(!$user->save()){
            echo '<pre>'; print_r($user->errors);die; 
        }
        $user->save(false);
        $event_id = '';
        $event_details=array();
        if($user->login_type == 'exhibitor'){
               $modelIsEventExhibitors = new $this->modelIsEventExhibitors;
               $Exbi = $modelIsEventExhibitors->find()->select(['event_id'])->where(['exhibitor_id'=>$user->id])->one();
               if(!empty($Exbi)){
                   $event_id = $Exbi->event_id;
               }
               if(!empty($event_id))
               {
                   $modelEvent = new $this->modelEvents;
                   $event_details= $modelEvent->find()->where(['id'=>$event_id])->one()->attributes;
               }
        }
        
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
            'event_id'=> $event_id,
            'event_details'=> $event_details,
          );
                
        $post = Yii::$app->request->post();
        
        if($isPass){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
        }else{
            echo json_encode(array('status'=>0,'message'=>"Wrong username or password",'data'=>array()),JSON_PRETTY_PRINT);
        }
        
        die;
    }
   
   public function actionSpeakers(){
       $event_id = $_POST['event_id'];
       $data=array();
       
       $modelIsEventSpeaker = new $this->modelIsEventSpeaker;
       $modelEventSpeakerIds = $modelIsEventSpeaker->find()->select('event_speaker_id')->where(['event_id' => $event_id])->all();
       
       if(!empty($modelEventSpeakerIds))
       {
           $i=0;
           foreach($modelEventSpeakerIds as $modelEventSpeakerId)
           {
               $data[$i]["id"] = $modelEventSpeakerId->eventSpeaker->id;
               $data[$i]["speaker_name"]= $modelEventSpeakerId->eventSpeaker->speaker_name;
               $data[$i]["speaker_designation"]= $modelEventSpeakerId->eventSpeaker->speakersRole->role_name;
               $data[$i]["speaker_image"]= $modelEventSpeakerId->eventSpeaker->speaker_image;
               $data[$i]["speaker_bio"]= $modelEventSpeakerId->eventSpeaker->speaker_details;
               $data[$i]["company_name"]= '';
               
               $modelEventShow=new $this->modelEventShow();
               $modelEventTopicsDatas = $modelEventShow->find()->where(['event_id' => $event_id])->where(['event_speaker_id' => $modelEventSpeakerId->event_speaker_id])->all();
               
               if(!empty($modelEventTopicsDatas))
               {
                   $j=0;
                   foreach($modelEventTopicsDatas as $modelEventTopicsData)
                   {
                        $data[$i]["topics"][$j]['show_name']= $modelEventTopicsData->show_name;       
                        $data[$i]["topics"][$j]['show_description']= $modelEventTopicsData->show_description;       
                        $data[$i]["topics"][$j]['start_time']= date_format(date_create($modelEventTopicsData->start_time),"m-d-Y g A");       
                        $data[$i]["topics"][$j]['end_time']= date_format(date_create($modelEventTopicsData->end_time),"m-d-Y g A");              
                        $data[$i]["topics"][$j]['location']= $modelEventTopicsData->showLocationSlot->slot_type.",".$modelEventTopicsData->showLocationSlot->slot_name;       
                        $j++;
                   }
                    
               }
               else
               {
                   $data[$i]["topics"]= array();
               }
               
               
               $i++;
           }
       }
       
       if($data){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
       }else{
            echo json_encode(array('status'=>0,'message'=>"No Data Found",'data'=>array()),JSON_PRETTY_PRINT);
       }
       die;
   }  
   public function actionExibitors(){
       $event_id = $_POST['event_id'];
       $data=array();
       
       $modelIsEventExhibitors = new $this->modelIsEventExhibitors;
       $modelIsEventExhibitorsIds = $modelIsEventExhibitors->find()->where(['event_id' => $event_id])->all();
       
       if(!empty($modelIsEventExhibitorsIds))
       {
           $i=0;
           foreach($modelIsEventExhibitorsIds as $modelIsEventExhibitorsId)
           {
               
               
               $modelSettings= new $this->modelSettings;  
               $meetingSlots = $modelSettings->SplitTimeByDate($modelIsEventExhibitorsId->event->start_time, $modelIsEventExhibitorsId->event->end_time, "30",$modelIsEventExhibitorsId->exhibitornew->user_id,$event_id); 
               
               $data[$i]['id'] = $modelIsEventExhibitorsId->exhibitornew->user_id;
               $data[$i]['gender'] = $modelIsEventExhibitorsId->exhibitornew->gender;
               $data[$i]['birthdate'] = $modelIsEventExhibitorsId->exhibitornew->birthdate;
               $data[$i]['company_logo'] = $modelIsEventExhibitorsId->exhibitornew->company_logo;
               $data[$i]['company_name'] = $modelIsEventExhibitorsId->exhibitornew->company_name;
               $data[$i]['company_site_url'] = $modelIsEventExhibitorsId->exhibitornew->company_site_url;
               $data[$i]['company_address'] = $modelIsEventExhibitorsId->exhibitornew->company_address;
               $data[$i]['company_detail'] = $modelIsEventExhibitorsId->exhibitornew->company_detail;
               $data[$i]['firstname'] = $modelIsEventExhibitorsId->exhibitornew->user->firstname;
               $data[$i]['lastname'] = $modelIsEventExhibitorsId->exhibitornew->user->lastname;
               $data[$i]['email'] = $modelIsEventExhibitorsId->exhibitornew->user->email;
               $data[$i]['profile_image'] = $modelIsEventExhibitorsId->exhibitornew->user->profile_image;
               $data[$i]['coutnries'] = !empty($modelIsEventExhibitorsId->exhibitornew->user->country)?explode(',',$modelIsEventExhibitorsId->exhibitornew->user->country):array();
               $data[$i]['technologies'] = !empty($modelIsEventExhibitorsId->exhibitornew->user->technology)?explode(',',$modelIsEventExhibitorsId->exhibitornew->user->technology):array();
               $data[$i]['facebook_profile'] = is_null($modelIsEventExhibitorsId->exhibitornew->user->facebook_profile)?'':$modelIsEventExhibitorsId->exhibitornew->user->facebook_profile;
               $data[$i]['instagram_profile'] = is_null($modelIsEventExhibitorsId->exhibitornew->user->instagram_profile)?'':$modelIsEventExhibitorsId->exhibitornew->user->instagram_profile;
               $data[$i]['youtube_profile'] = is_null($modelIsEventExhibitorsId->exhibitornew->user->youtube_profile)?'':$modelIsEventExhibitorsId->exhibitornew->user->youtube_profile;
               $data[$i]['linkedin_profile'] = is_null($modelIsEventExhibitorsId->exhibitornew->user->linkedin_profile)?'':$modelIsEventExhibitorsId->exhibitornew->user->linkedin_profile;
               $data[$i]['twitter_profile'] = is_null($modelIsEventExhibitorsId->exhibitornew->user->twitter_profile)?'':$modelIsEventExhibitorsId->exhibitornew->user->linkedin_profile;
               $data[$i]['hall'] = $modelIsEventExhibitorsId->eventLocation->location_name;
               $data[$i]['booth'] = $modelIsEventExhibitorsId->eventLocationBooth->booth_name;
               $data[$i]['meeting_slots'] = $meetingSlots ;
               
               $i++;
           }
       }
       
       if($data){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
       }else{
            echo json_encode(array('status'=>0,'message'=>"No Data Found",'data'=>array()),JSON_PRETTY_PRINT);
       }
       die;
   }  
   public function actionEvents(){
       
       $data=array();
       $visitor_id=$_GET['user_id'];
       $modelEvents = new $this->modelEvents;
       $modelCurrentEventsData = $modelEvents->find()->where(['<=','start_time',date('Y-m-d H:i:s')])->andWhere(['>=','end_time',date('Y-m-d H:i:s')])->orderby(['start_time'=>SORT_ASC])->all();
     //  echo "<pre>";print_r($modelCurrentEventsData);die; 
       if(!empty($modelCurrentEventsData))
       {
           $i=0;
           foreach($modelCurrentEventsData as $cdata)
           {
               $data['current_events'][$i]=$cdata->attributes;
               $data['current_events'][$i]['start_time']=date_format(date_create($cdata->start_time),"m-d-Y g A");       
               $data['current_events'][$i]['end_time']=date_format(date_create($cdata->end_time),"m-d-Y g A");    
               $data['current_events'][$i]['event_logo']='';
               
               $modelAttandees = new $this->modelAttandees;
               $modelAttandeesExist = $modelAttandees->find()->where(['event_id'=>$cdata->id])->andWhere(['visitor_id'=>$visitor_id])->exists();
               
               $data['current_events'][$i]['attend_flag']=($modelAttandeesExist)?1:0;
           }
       }
       else
       {
           $data['current_events']=array();
       }
       
       $modelUpcomingEventsData = $modelEvents->find()->where(['>','start_time',date('Y-m-d H:i:s')])->andWhere(['>','end_time',date('Y-m-d H:i:s')])->orderby(['start_time'=>SORT_ASC])->all();
       
       if(!empty($modelUpcomingEventsData))
       {
           $i=0;
           foreach($modelUpcomingEventsData as $udata)
           {
               $data['upcoming_events'][$i]=$udata->attributes;
               $data['upcoming_events'][$i]['start_time']=date_format(date_create($udata->start_time),"m-d-Y g A");       
               $data['upcoming_events'][$i]['end_time']=date_format(date_create($udata->end_time),"m-d-Y g A");    
               $data['upcoming_events'][$i]['event_logo']='';
               
               $modelAttandees = new $this->modelAttandees;
               $modelAttandeesExist = $modelAttandees->find()->where(['event_id'=>$udata->id])->andWhere(['visitor_id'=>$visitor_id])->exists();
               
               $data['upcoming_events'][$i]['attend_flag']=($modelAttandeesExist)?1:0;
           }
       }
       else
       {
           $data['upcoming_events']=array();
       }
       
       $modelPastEventsData = $modelEvents->find()->where(['<','end_time',date('Y-m-d H:i:s')])->orderby(['start_time'=>SORT_ASC])->all();
       
       if(!empty($modelPastEventsData))
       {
           $i=0;
           foreach($modelPastEventsData as $pdata)
           {
               $data['past_events'][$i]=$pdata->attributes;
               $data['past_events'][$i]['start_time']=date_format(date_create($pdata->start_time),"m-d-Y g A");       
               $data['past_events'][$i]['end_time']=date_format(date_create($pdata->end_time),"m-d-Y g A");    
               $data['past_events'][$i]['event_logo']='';
               
               $modelAttandees = new $this->modelAttandees;
               $modelAttandeesExist = $modelAttandees->find()->where(['event_id'=>$pdata->id])->andWhere(['visitor_id'=>$visitor_id])->exists();
               
               $data['past_events'][$i]['attend_flag']=($modelAttandeesExist)?1:0;
           }
       }
       else
       {
           $data['past_events']=array();
       }
       
       if($data){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>$data),JSON_PRETTY_PRINT);
       }else{
            echo json_encode(array('status'=>0,'message'=>"No Data Found",'data'=>array()),JSON_PRETTY_PRINT);
       }
       die;
   }  
   
   public function actionAttendevent(){
       
       $data=array();
       
       $event_id = $_POST['event_id'];
       $visitor_id = $_POST['user_id'];
       $attend_status = $_POST['attend_status']; // 0-unattend , 1- attend
   
       $modelAttandees = new $this->modelAttandees;
       $modelAttandeesExist = $modelAttandees->find()->where(['event_id'=>$event_id])->andWhere(['visitor_id'=>$visitor_id])->exists();
       
       if($attend_status)
       {
           if(!$modelAttandeesExist)
           {
              $modelAttandees->event_id=$event_id;
              $modelAttandees->visitor_id=$visitor_id;
              $modelAttandees->status=1;
              $modelAttandees->created_at=date('Y-m-d H:i:s');
              
              if(!$modelAttandees->save())
              {
                    echo json_encode(array('status'=>0,'message'=>$modelAttandees->errors,'data'=>array()),JSON_PRETTY_PRINT);           
              }
              else
              {
                    echo json_encode(array('status'=>1,'message'=>'Successfully Registered','data'=>array()),JSON_PRETTY_PRINT); 
              }
           }
           else
           {
                echo json_encode(array('status'=>0,'message'=>"You are alrerady registered with this event",'data'=>array()),JSON_PRETTY_PRINT);
           }
       }
       else
       {
           if(!empty($modelAttandeesExist))
           {
              $modelAttandeesData= $modelAttandees->find()->where(['event_id'=>$event_id])->andWhere(['visitor_id'=>$visitor_id])->one(); 
              $modelAttandeesDataSuccess=$modelAttandeesData->delete();
              if($modelAttandeesDataSuccess)
              {
                  echo json_encode(array('status'=>1,'message'=>'Successfully Unregistered','data'=>array()),JSON_PRETTY_PRINT);         
              }
              else
              {
                  echo json_encode(array('status'=>0,'message'=>"Something went wrong, please try again",'data'=>array()),JSON_PRETTY_PRINT);           
              }
           }
       }
       
      
       die;
   }  
   
   public function actionMeetingrequestlist(){
       $user_id = $_POST['user_id'];
       
       $modelExhibitorMeetings = new $this->modelExhibitorMeetings;
       //$modelExhibitorMeetings 
   }
   public function actionMeetingrequest(){
       $event_id = $_POST['event_id'];
       $user_id = $_POST['user_id'];
       $exhibitor_id = $_POST['exhibitor_id'];
       $meeting_date = $_POST['meeting_date'];
       $meeting_time = $_POST['meeting_time'];
       $login_type = $_POST['login_type'];
       
       $modelExhibitorMeetings = new $this->modelExhibitorMeetings;
       $modelExhibitorMeetings->event_id=$event_id;
       $modelExhibitorMeetings->exhibitor_id=$exhibitor_id;
       $modelExhibitorMeetings->user_id=$user_id;
       $modelExhibitorMeetings->user_type=$login_type;
       $modelExhibitorMeetings->meeting_date=$meeting_date;
       $modelExhibitorMeetings->meeting_time=$meeting_time;
       $modelExhibitorMeetings->confirmed=0;
       $modelExhibitorMeetings->created_at=date('Y-m-d H:i:s');
       
       if($modelExhibitorMeetings->save()){
            echo json_encode(array('status'=>1,'message'=>'Success','data'=>array()),JSON_PRETTY_PRINT);
       }else{
            echo json_encode(array('status'=>0,'message'=>"Something Went Wrong",'data'=>array()),JSON_PRETTY_PRINT);
       }
       die;
   } 
   
   
   public function actionMeetingconfirmation(){
       $request_id = $_POST['request_id'];
       $confirm_status = $_POST['confirm_status'];
       
       $modelExhibitorMeetings = new $this->modelExhibitorMeetings;
       $modelExhibitorMeetingsData=$modelExhibitorMeetings->find()->where(['id'=>$request_id])->one();
       
       if($modelExhibitorMeetingsData->confirmed==1 && $confirm_status==1)
       {
           echo json_encode(array('status'=>0,'message'=>"Slot is already occupied",'data'=>array()),JSON_PRETTY_PRINT);die;
       }
       
       if($modelExhibitorMeetingsData->confirmed==0 && $confirm_status==1)
       {
           $modelExhibitorMeetingsData->confirmed=1;
       }
       
       if($modelExhibitorMeetingsData->confirmed==1 && $confirm_status==2)
       {
           $modelExhibitorMeetingsData->confirmed=2; // rejected
       }
       
       
       if($modelExhibitorMeetingsData->save()){
           if($confirm_status==1)
                echo json_encode(array('status'=>1,'message'=>'Meeting fixed','data'=>array()),JSON_PRETTY_PRINT);
           else
                echo json_encode(array('status'=>1,'message'=>'Meeting Rejected','data'=>array()),JSON_PRETTY_PRINT);
       }else{
            echo json_encode(array('status'=>0,'message'=>"Something Went Wrong",'data'=>array()),JSON_PRETTY_PRINT);
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


