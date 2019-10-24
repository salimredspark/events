<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "attandees".
 *
 * @property int $id
 * @property int $event_id
 * @property int $visitor_id
 * @property int $status
 * @property string $created_at
 *
 * @property Events $event
 * @property User $visitor
 */
class Attandees extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'attandees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id', 'visitor_id', 'created_at'], 'required'],
            [['event_id', 'visitor_id', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['visitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['visitor_id' => 'id']],
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
            'visitor_id' => 'Visitor ID',
            'status' => 'Status',
            'created_at' => 'Created At',
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
    public function getVisitor()
    {
        return $this->hasOne(User::className(), ['id' => 'visitor_id']);
    }
}
