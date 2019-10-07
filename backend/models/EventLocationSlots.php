<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_location_slots".
 *
 * @property int $id
 * @property int $event_location_id
 * @property string $slot_type hotel room or hall
 * @property string $slot_name
 * @property string $slot_detail
 * @property int $updated_by
 *
 * @property EventLocation $eventLocation
 * @property User $updatedBy
 */
class EventLocationSlots extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_location_slots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_location_id', 'slot_type', 'slot_name', 'slot_detail', 'updated_by'], 'required'],
            [['event_location_id', 'updated_by'], 'integer'],
            [['slot_detail'], 'string'],
            [['slot_type', 'slot_name'], 'string', 'max' => 255],
            [['event_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocation::className(), 'targetAttribute' => ['event_location_id' => 'id']],
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
            'event_location_id' => 'Event Location ID',
            'slot_type' => 'Slot Type',
            'slot_name' => 'Slot Name',
            'slot_detail' => 'Slot Detail',
            'updated_by' => 'Updated By',
        ];
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
