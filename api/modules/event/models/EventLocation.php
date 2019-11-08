<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "event_location".
 *
 * @property int $id
 * @property string $location_name
 * @property string $location_details
 * @property int $updated_by
 *
 * @property User $updatedBy
 * @property EventLocationSlots[] $eventLocationSlots
 */
class EventLocation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_name', 'location_details', 'updated_by'], 'required'],
            [['updated_by'], 'integer'],
            [['location_name', 'location_details'], 'string', 'max' => 255],
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
            'location_name' => 'Location Name',
            'location_details' => 'Location Details',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEventLocationSlots()
    {
        return $this->hasMany(EventLocationSlots::className(), ['event_location_id' => 'id']);
    }
}
