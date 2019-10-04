<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "hotels".
 *
 * @property int $id
 * @property string $hotel_name
 * @property string $hotel_address
 * @property string $hotel_website
 * @property string $hotel_detail
 * @property int $updated_by
 *
 * @property User $updatedBy
 */
class Hotels extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hotels';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hotel_name', 'hotel_address', 'hotel_website', 'hotel_detail', 'updated_by'], 'required'],
            [['hotel_detail'], 'string'],
            [['updated_by'], 'integer'],
            [['hotel_name', 'hotel_address', 'hotel_website'], 'string', 'max' => 255],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'hotel_name' => 'Hotel Name',
            'hotel_address' => 'Hotel Address',
            'hotel_website' => 'Hotel Website',
            'hotel_detail' => 'Hotel Detail',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    
    public function getTravelOption()
    {
        return [            
            'Flight' => 'Flight',
            'Car' => 'Car',
            'Train' => 'Train',
            'Self Manage' => 'Self Manage',            
        ];
    }
    
    public function getHotelPatnerOption()
    {
        return [            
            'yatra.com' => 'Yatra',
            'makemytrip.com' => 'Makemytrip',
            'cleartrip.com' => 'Cleartrip',
            'goibibo.com' => 'Goibibo',
            'trivago.in' => 'Trivago',
            'expedia.co.in' => 'Expedia',
            'redbus.in' => 'Redbus',
            'agoda.com' => 'Agoda',
            'hotels.com' => 'Hotels',            
        ];
    }
}
