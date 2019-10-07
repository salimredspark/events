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

        if(empty($date)) return $date;

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
            
    public function getTimeAgo( $time, $string = 'number' )
    {
        if(empty($time)) return $time;                

        if($string == 'number'){ 
            $time = strtotime($time);
        }
        
        $diff = $time - time(); //strtotime('2019-10-07 15:22:22'); 
        
        if( $diff < 1 ) {  
            return ' 1 second ago';  
        } 

        $time_rules = array (  
        12 * 30 * 24 * 60 * 60 => 'year', 
        30 * 24 * 60 * 60       => 'month', 
        24 * 60 * 60           => 'day', 
        60 * 60                   => 'hour', 
        60                       => 'minute', 
        1                       => 'second'
        ); 
         
        foreach( $time_rules as $secs => $str ) { 
            $div = $diff / $secs; 
            if( $div >= 1 ) { 
                $t = round( $div );       
                return $t . ' ' . $str .  
                ( $t > 1 ? 's' : '' ) . ' ago'; 
            } 
        }      
    }
}

