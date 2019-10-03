<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "speakers".
 *
 * @property int $id
 * @property string $speaker_name
 * @property string $speaker_details
 * @property int $updated_by
 *
 * @property IsEventSpeaker[] $isEventSpeakers
 * @property User $updatedBy
 */
class Speakers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'speakers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['speaker_name', 'speaker_details', 'updated_by'], 'required'],
            [['speaker_details'], 'string'],
            [['updated_by'], 'integer'],
            [['speaker_name'], 'string', 'max' => 255],
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
            'speaker_name' => 'Speaker Name',
            'speaker_details' => 'Speaker Details',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsEventSpeakers()
    {
        return $this->hasMany(IsEventSpeaker::className(), ['event_speaker_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
