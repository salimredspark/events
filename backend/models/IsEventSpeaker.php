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
 * @property int $hotel_id
 * @property string $hotel_room_number
 * @property int $hotel_book_by
 *
 * @property Events $event
 * @property Speakers $eventSpeaker
 * @property SpeakerRole $eventSpeakerRole
 * @property Hotels $hotel
 * @property User $hotelBookBy
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
            [['event_id', 'event_speaker_id', 'event_speaker_role_id', 'hotel_id', 'hotel_room_number', 'hotel_book_by'], 'required'],
            [['event_id', 'event_speaker_id', 'event_speaker_role_id', 'hotel_id', 'hotel_book_by'], 'integer'],
            [['hotel_room_number', 'hotel_patner', 'speaker_travel_by'], 'string', 'max' => 150],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['event_speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['event_speaker_id' => 'id']],
            [['event_speaker_role_id'], 'exist', 'skipOnError' => true, 'targetClass' => SpeakerRole::className(), 'targetAttribute' => ['event_speaker_role_id' => 'id']],
            [['hotel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Hotels::className(), 'targetAttribute' => ['hotel_id' => 'id']],
            [['hotel_book_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['hotel_book_by' => 'id']],
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
            'hotel_id' => 'Hotel ID',
            'hotel_room_number' => 'Hotel Room Number',
            'hotel_book_by' => 'Hotel Book By',
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
    public function getHotel()
    {
        return $this->hasOne(Hotels::className(), ['id' => 'hotel_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHotelBookBy()
    {
        return $this->hasOne(User::className(), ['id' => 'hotel_book_by']);
    }
}
