<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "is_event_exhibitors".
 *
 * @property int $id
 * @property int $event_id
 * @property int $exhibitor_id
 * @property int $event_location_id
 * @property int $event_location_booth_id
 * @property string $comment
 *
 * @property Events $event
 * @property User $exhibitor
 * @property EventLocation $eventLocation
 * @property EventLocationSlots $eventLocationSlot
 */
class IsEventExhibitors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'is_event_exhibitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'exhibitor_id', 'event_location_id', 'event_location_booth_id', 'comment'], 'required'],
            [['event_id', 'exhibitor_id', 'event_location_id', 'event_location_booth_id'], 'integer'],
            [['comment'], 'string'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['exhibitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['exhibitor_id' => 'id']],
            [['event_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocation::className(), 'targetAttribute' => ['event_location_id' => 'id']],
            [['event_location_booth_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocationSlots::className(), 'targetAttribute' => ['event_location_booth_id' => 'id']],
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
            'exhibitor_id' => 'Exhibitor ID',
            'event_location_id' => 'Event Location ID',
            'event_location_booth_id' => 'Event Location Slot ID',
            'comment' => 'Comment',
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
    public function getExhibitor()
    {
        return $this->hasOne(User::className(), ['id' => 'exhibitor_id']);
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
        return $this->hasOne(EventLocationSlots::className(), ['id' => 'event_location_booth_id']);
    }
}
