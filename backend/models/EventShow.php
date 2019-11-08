<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_show".
 *
 * @property int $id
 * @property string $show_name
 * @property int $show_location_id
 * @property int $show_location_slot_id
 * @property string $show_description
 * @property string $start_time
 * @property string $end_time
 * @property int $event_id
 * @property int $event_speaker_id
 * @property int $event_speaker_role_id
 * @property int $show_manage_by
 * @property int $updated_by
 *
 * @property Events $event
 * @property User $updatedBy
 * @property Speakers $eventSpeaker
 * @property SpeakerRole $eventSpeakerRole
 * @property EventLocation $showLocation
 * @property EventLocationSlots $showLocationSlot
 */
class EventShow extends \yii\db\ActiveRecord
{
    public $new_speaker_name;
    public $event_speaker_role_id;
    public $event_speaker_bio;
    public $event_speaker_id;
        
    public static function tableName(){
        return 'event_show';
    }
        
    public function rules()
    {
        return [
            [['show_name', 'show_location_id', 'show_location_slot_id', 'show_description', 'topic_type_id', 'event_id', 'show_manage_by', 'updated_by'], 'required'],
            [['show_location_id', 'show_location_slot_id', 'event_id', 'event_moderator_id', 'show_manage_by', 'updated_by'], 'integer'],
            [['show_description'], 'string'],
            [['start_time', 'end_time', 'event_speaker_id', 'event_speaker_role_id', 'event_speaker_bio', 'new_speaker_name'], 'safe'],
            [['show_name'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            //[['event_speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['event_speaker_id' => 'id']],
            [['event_moderator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['event_moderator_id' => 'id']],
            [['show_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocation::className(), 'targetAttribute' => ['show_location_id' => 'id']],
            [['show_location_slot_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocationSlots::className(), 'targetAttribute' => ['show_location_slot_id' => 'id']],
            [['topic_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventType::className(), 'targetAttribute' => ['topic_type_id' => 'id']],
        ];
    }
        
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_name' => 'Show Name',
            'show_location_id' => 'Show Location ID',
            'show_location_slot_id' => 'Show Location Slot ID',
            'show_description' => 'Show Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'event_id' => 'Event ID',
            'topic_type_id' => 'Event Type ID',
            //'event_speaker_id' => 'Event Speaker ID',
            'event_moderator_id' => 'Event Moderator',
            'show_manage_by' => 'Show Manage By',
            'updated_by' => 'Updated By',
        ];
    }
    
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }

    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    public function getEventSpeaker()
    {
        return $this->hasOne(Speakers::className(), ['id' => 'event_speaker_id']);
    }

    public function getEventSpeakerRole()
    {
        return $this->hasOne(Speakers::className(), ['id' => 'event_moderator_id']);
    }

    public function getShowLocation()
    {
        return $this->hasOne(EventLocation::className(), ['id' => 'show_location_id']);
    }

    public function getShowLocationSlot()
    {
        return $this->hasOne(EventLocationSlots::className(), ['id' => 'show_location_slot_id']);
    }
}
