<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "is_event_speaker".
 *
 * @property int $id
 * @property int $event_id
 * @property int $event_speaker_id
 * @property int $event_speaker_role_id
 * @property int $event_location_id
 * @property int $event_location_slot_id
 *
 * @property Events $event
 * @property Speakers $eventSpeaker
 * @property SpeakerRole $eventSpeakerRole
 * @property EventLocation $eventLocation
 * @property EventLocationSlots $eventLocationSlot
 */
class IsEventSpeaker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'is_event_speaker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'event_speaker_id', 'event_speaker_role_id', 'event_location_id', 'event_location_slot_id'], 'required'],
            [['event_id', 'event_speaker_id', 'event_speaker_role_id', 'event_location_id', 'event_location_slot_id'], 'integer'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['event_speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['event_speaker_id' => 'id']],
            [['event_speaker_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpeakerRole::className(), 'targetAttribute' => ['event_speaker_role_id' => 'id']],
            [['event_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocation::className(), 'targetAttribute' => ['event_location_id' => 'id']],
            [['event_location_slot_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocationSlots::className(), 'targetAttribute' => ['event_location_slot_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'event_id' => 'Event ID',
            'event_speaker_id' => 'Event Speaker ID',
            'event_speaker_role_id' => 'Event Speaker Role ID',
            'event_location_id' => 'Event Location ID',
            'event_location_slot_id' => 'Event Location Slot ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Events::className(), ['id' => 'event_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventSpeaker()
    {
        return $this->hasOne(Speakers::className(), ['id' => 'event_speaker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventSpeakerRole()
    {
        return $this->hasOne(SpeakerRole::className(), ['id' => 'event_speaker_role_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventLocation()
    {
        return $this->hasOne(EventLocation::className(), ['id' => 'event_location_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventLocationSlot()
    {
        return $this->hasOne(EventLocationSlots::className(), ['id' => 'event_location_slot_id']);
    }
}
