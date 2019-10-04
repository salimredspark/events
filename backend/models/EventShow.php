<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_show".
 *
 * @property int $id
 * @property string $show_name
 * @property string $show_location
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
 */
class EventShow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_show';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['show_name', 'show_location', 'show_description', 'event_id', 'event_speaker_id', 'event_speaker_role_id', 'show_manage_by', 'updated_by'], 'required'],
            [['show_description'], 'string'],
            [['start_time', 'end_time'], 'safe'],
            [['event_id', 'event_speaker_id', 'event_speaker_role_id', 'show_manage_by', 'updated_by'], 'integer'],
            [['show_name', 'show_location'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['event_speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['event_speaker_id' => 'id']],
            [['event_speaker_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpeakerRole::className(), 'targetAttribute' => ['event_speaker_role_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'show_name' => 'Show Name',
            'show_location' => 'Show Location',
            'show_description' => 'Show Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'event_id' => 'Event ID',
            'event_speaker_id' => 'Event Speaker ID',
            'event_speaker_role_id' => 'Event Speaker Role ID',
            'show_manage_by' => 'Show Manage By',
            'updated_by' => 'Updated By',
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
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
}
