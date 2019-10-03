<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "event_type".
 *
 * @property int $id
 * @property string $type_name
 * @property int $updated_by
 *
 * @property User $updatedBy
 * @property Events[] $events
 */
class EventType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_name', 'color', 'updated_by'], 'required'],
            [['updated_by'], 'integer'],
            [['type_name', 'color'], 'string', 'max' => 250],
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
            'type_name' => 'Type Name',
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
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['event_type_id' => 'id']);
    }
}
