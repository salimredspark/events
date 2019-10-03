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
 * @property int $updated_by
 *
 * @property Events $event
 * @property User $updatedBy
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
            [['show_name', 'show_location', 'show_description', 'event_id', 'updated_by'], 'required'],
            [['show_description'], 'string'],
            [['start_time', 'end_time'], 'safe'],
            [['event_id', 'updated_by'], 'integer'],
            [['show_name', 'show_location'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
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
            'show_name' => 'Show Name',
            'show_location' => 'Show Location',
            'show_description' => 'Show Description',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'event_id' => 'Event ID',
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
}
