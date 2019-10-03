<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "events".
 *
 * @property int $id
 * @property int $event_name
 * @property string $event_domain_name
 * @property int $event_type_id
 * @property int $event_location_id
 * @property resource $event_description
 * @property string $start_time
 * @property string $end_time
 * @property int $updated_by
 *
 * @property EventShow[] $eventShows
 * @property Locations $eventLocation
 * @property EventType $eventType
 * @property User $updatedBy
 * @property IsEventSpeaker[] $isEventSpeakers
 */
class Events extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'events';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_name', 'event_domain_name', 'event_type_id', 'event_location', 'event_description', 'updated_by'], 'required'],
            [['event_type_id', 'updated_by'], 'integer'],
            [['event_description'], 'string'],
            [['start_time', 'end_time'], 'safe'],
            [['event_domain_name'], 'string', 'max' => 255],
            [['event_domain_name'], 'unique'],            
            [['event_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['event_type_id' => 'id']],
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
            'event_name' => 'Event Name',
            'event_domain_name' => 'Event Domain Name',
            'event_type_id' => 'Event Type ID',
            'event_location' => 'Event Location',
            'event_description' => 'Event Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventShows()
    {
        return $this->hasMany(EventShow::className(), ['event_id' => 'id']);
    }
       
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventType()
    {
        return $this->hasOne(EventType::className(), ['id' => 'event_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsEventSpeakers()
    {
        return $this->hasMany(IsEventSpeaker::className(), ['event_id' => 'id']);
    }
}
