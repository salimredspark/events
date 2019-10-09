<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "is_event_exhibitors".
 *
 * @property int $id
 * @property int $event_id
 * @property int $exhibitor_id
 * @property string $exhibitor_join_status yes, no, maybe
 * @property string $comment
 *
 * @property Events $event
 * @property Exhibitors $exhibitor
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
            [['event_id', 'exhibitor_id', 'exhibitor_join_status', 'comment'], 'required'],
            [['event_id', 'exhibitor_id'], 'integer'],
            [['comment'], 'string'],
            [['exhibitor_join_status'], 'string', 'max' => 20],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['exhibitor_id'], 'exist', 'skipOnError' => true, 'targetClass' => Exhibitors::className(), 'targetAttribute' => ['exhibitor_id' => 'id']],
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
            'exhibitor_join_status' => 'Exhibitor Join Status',
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
        return $this->hasOne(Exhibitors::className(), ['id' => 'exhibitor_id']);
    }
}
