<?php

namespace backend\models;

use Yii;

/**
* This is the model class for table "settings".
*
* @property int $id
* @property string $setting_key
* @property string $setting_value
*/
class Settings extends \yii\db\ActiveRecord
{      
    public static function tableName(){
        return 'settings';
    }

    public function rules(){
        return [
        [['setting_key', 'setting_value'], 'required'],
        [['setting_value'], 'string'],
        [['setting_key'], 'string', 'max' => 255],
        ];
    }
        
    public function attributeLabels(){
        return [
        'id' => 'ID',
        'setting_key' => 'Setting Key',
        'setting_value' => 'Setting Value',
        ];
    }

    public function getConfigData($field){              
        return Settings::find()->where(['setting_key' => $field])->one()->setting_value;
    }

    public function getDomainUrl($domain){
        $main_domain = Settings::find()->where(['setting_key' => 'main_domain'])->one()->setting_value;                
        if(!empty($main_domain)){
            $main_domain = str_replace("*", $domain, $main_domain);
            return 'http://'.$main_domain;
        }
        return 'http://'.$domain;
    }

    public static function getConfigDateTime($date, $string = 'number', $param = 'datetime'){

        if(empty($date) || $date == '0000-00-00') return '';

        //if date save as date format then it will not conver into strtotime
        if($string == 'number'){ 
            $date = strtotime($date);
        }

        //get date format
        $date_format = Settings::find()->where(['setting_key' => 'date_format'])->one()->setting_value;                        
        if($param == 'date'){
            $return = date($date_format, $date);
        }

        //get time format
        $time_format = Settings::find()->where(['setting_key' => 'time_format'])->one()->setting_value;                
        if($param == 'time'){
            $return = date($time_format, $date);
        }

        //get Date and Time format        
        if($param == 'datetime'){            
            $return = date($date_format.' '.$time_format, $date);            
        }

        return $return;
    }

    public static function getTimeAgo( $timestamp, $string = 'number' ){

        if(empty($timestamp)) return $timestamp;                

        /*$timezone = Settings::find()->where(['setting_key' => 'timezone'])->one()->setting_value;
        $timezone = (empty($timezone) ? 'Asia/Kolkata' : $timezone);
        date_default_timezone_set($timezone); 
        */ 
        //if($timestamp == 'number'){  $timestamp = strtotime($timestamp); }                        

        $time_ago = strtotime($timestamp);
        $current_time    = time();
        $time_difference = $current_time - $time_ago;
        $seconds         = $time_difference;

        $minutes = round($seconds / 60); // value 60 is seconds  
        $hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec  
        $days    = round($seconds / 86400); //86400 = 24 * 60 * 60;  
        $weeks   = round($seconds / 604800); // 7*24*60*60;  
        $months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60  
        $years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

        if ($seconds <= 60){
            return "Just Now";
        } elseif ($minutes <= 60){
            if ($minutes == 1){
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } elseif ($hours <= 24){
            if ($hours == 1){
                return "an hour ago";
            } else {
                return "$hours hrs ago";
            }
        } elseif ($days <= 7){
            if ($days == 1){
                return "Yesterday";
            } else {
                return "$days days ago";
            }
        } elseif ($weeks <= 4.3){
            if ($weeks == 1){
                return "a week ago";
            } else {
                return "$weeks weeks ago";
            }
        } elseif ($months <= 12){
            if ($months == 1){
                return "a month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1){
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }

    public static function SplitTime($StartTime, $EndTime, $Duration="30"){
        $ReturnArray = array ();// Define output
        
        $StartTime    = strtotime ($StartTime); //Get Timestamp
        $EndTime      = strtotime ($EndTime); //Get Timestamp

        $AddMins  = $Duration * 60;

        while ($StartTime <= $EndTime) //Run loop
        {               
            //$ReturnArray[] = Settings::getConfigDateTime($StartTime, 'string');
            //$StartTime += $AddMins; //Endtime check
            
            $_dateKey = Settings::getConfigDateTime($StartTime, 'string', 'date');
            $ReturnArray[$_dateKey][] = Settings::getConfigDateTime($StartTime, 'string');
            $StartTime += $AddMins; //Endtime check
        }
        return $ReturnArray;
    }
    
    public static function SplitTimeByDate($StartTime, $EndTime, $Duration="30",$exhibitor_id,$event_id){
        
        $days_diff = abs(round((strtotime($EndTime) - strtotime($StartTime))/ 86400)); 
        $start_date = date('Y-m-d',strtotime($StartTime)); 
        $start_time_original=$start_time = strtotime(date('H:i',strtotime($StartTime))); 
        $end_time = strtotime(date('H:i',strtotime($EndTime))); 
        
        for($i=0;$i<=$days_diff;$i++)
        {
            $start_time=$start_time_original;
            $AddMins  = $Duration * 60;
            $j=0;
            $ReturnArray[$i]['date'] = Settings::getConfigDateTime($start_date, 'number', 'date');
            while ($start_time <= $end_time) 
            {
                
                $exhibitorMeetingsCount=ExhibitorMeetings::find()->where(['event_id'=>$event_id])->andWhere(['exhibitor_id'=>$exhibitor_id])->andWhere(['confirmed'=>1])->andWhere(['meeting_date'=>$start_date])->andWhere(['meeting_time'=>date("h:i", $start_time)])->count();
                $ReturnArray[$i]['timeslots'][$j]['slot'] = Settings::getConfigDateTime($start_time,'','time');
                $ReturnArray[$i]['timeslots'][$j]['occupied'] = $exhibitorMeetingsCount;
                $start_time += $AddMins; 
                $j++;
            }
            
            $start_date = date('Y-m-d', strtotime($start_date . ' +1 day'));
        }
        
        //echo '<pre>';print_r($ReturnArray);echo '</pre>';die('developer is working');
        
        return $ReturnArray;
    }
}

