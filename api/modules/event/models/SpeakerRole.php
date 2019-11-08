<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "speaker_role".
 *
 * @property int $id
 * @property string $role_name
 * @property int $updated_by
 *
 * @property IsEventSpeaker[] $isEventSpeakers
 * @property User $updatedBy
 */
class SpeakerRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'speaker_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_name', 'updated_by'], 'required'],
            [['updated_by'], 'integer'],
            [['role_name'], 'string', 'max' => 255],
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
            'role_name' => 'Role Name',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsEventSpeakers()
    {
        return $this->hasMany(IsEventSpeaker::className(), ['event_speaker_role_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
