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

    /**
    * {@inheritdoc}
    */
    public static function tableName()
    {
        return 'settings';
    }

    /**
    * {@inheritdoc}
    */
    public function rules()
    {
        return [
        [['setting_key', 'setting_value'], 'required'],
        [['setting_value'], 'string'],
        [['setting_key'], 'string', 'max' => 255],
        ];
    }

    /**
    * {@inheritdoc}
    */
    public function attributeLabels()
    {
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

    public function getConfigDateTime($date, $string = 'number', $param = 'datetime'){

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

    public function getTimeAgo( $timestamp, $string = 'number' ){
        if(empty($timestamp)) return $timestamp;                

        if($timestamp == 'number'){ 
            $timestamp = strtotime($timestamp);
        }

        date_default_timezone_set("Asia/Kolkata");         
        $time_ago        = strtotime($timestamp);
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
                return "yesterday";
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
}

