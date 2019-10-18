<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "speaker_accommodation".
 *
 * @property int $id
 * @property int $speaker_id
 * @property int $event_id
 * @property int $show_id
 * @property string $category_name
 * @property string $category_item
 * @property string $category_item_qty
 * @property int $manage_by
 * @property int $updated_by
 *
 * @property Events $event
 * @property User $manageBy
 * @property EventShow $show
 * @property Speakers $speaker
 * @property User $updatedBy
 */
class SpeakerAccommodation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'speaker_accommodation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['speaker_id', 'event_id', 'show_id', 'category_name', 'category_item', 'category_item_qty', 'manage_by', 'updated_by'], 'required'],
            [['speaker_id', 'event_id', 'show_id', 'manage_by', 'updated_by'], 'integer'],
            [['category_name', 'category_item', 'category_item_qty'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['manage_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['manage_by' => 'id']],
            [['show_id'], 'exist', 'skipOnError' => true, 'targetClass' => EventShow::className(), 'targetAttribute' => ['show_id' => 'id']],
            [['speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['speaker_id' => 'id']],
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
            'speaker_id' => 'Speaker ID',
            'event_id' => 'Event ID',
            'show_id' => 'Show ID',
            'category_name' => 'Category Name',
            'category_item' => 'Category Item',
            'category_item_qty' => 'Category Item Qty',
            'manage_by' => 'Manage By',
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
    public function getManageBy()
    {
        return $this->hasOne(User::className(), ['id' => 'manage_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShow()
    {
        return $this->hasOne(EventShow::className(), ['id' => 'show_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpeaker()
    {
        return $this->hasOne(Speakers::className(), ['id' => 'speaker_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
