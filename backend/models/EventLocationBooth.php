<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_location_booth".
 *
 * @property int $id
 * @property int $event_location_id
 * @property string $booth_name
 * @property string $booth_detail
 * @property int $updated_by
 *
 * @property EventLocation $eventLocation
 */
class EventLocationBooth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_location_booth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_location_id', 'booth_name', 'booth_detail', 'updated_by'], 'required'],
            [['event_location_id', 'updated_by'], 'integer'],
            [['booth_detail'], 'string'],
            [['booth_name'], 'string', 'max' => 255],
            [['event_location_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventLocation::className(), 'targetAttribute' => ['event_location_id' => 'id']],
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
            'booth_name' => 'Booth Name',
            'booth_detail' => 'Booth Detail',
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
}
