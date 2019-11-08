<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "exhibitor_meetings".
 *
 * @property int $id
 * @property int $event_id
 * @property int $exhibitor_id
 * @property int $user_id
 * @property string $user_type
 * @property string $meeting_date
 * @property string $meeting_time
 * @property string $created_at
 *
 * @property User $exhibitor
 */
class ExhibitorMeetings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exhibitor_meetings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'exhibitor_id', 'user_id', 'meeting_date', 'meeting_time', 'created_at', 'confirmed'], 'required'],
            [['event_id', 'exhibitor_id', 'user_id'], 'integer'],
            [['user_type'], 'string'],
            [['meeting_date', 'created_at'], 'safe'],
            [['meeting_time'], 'string', 'max' => 100],
            [['exhibitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['exhibitor_id' => 'id']],
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
            'user_id' => 'User ID',
            'user_type' => 'User Type',
            'meeting_date' => 'Meeting Date',
            'meeting_time' => 'Meeting Time',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExhibitor()
    {
        return $this->hasOne(User::className(), ['id' => 'exhibitor_id']);
    }
}
