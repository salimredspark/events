<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "speaker_accommodation".
 *
 * @property int $id
 * @property int $speaker_id
 * @property int $event_id
 * @property int $category_id
 * @property int $vendor_id
 * @property string $category_item
 * @property string $category_item_qty
 * @property int $manage_by
 * @property int $updated_by
 *
 * @property Events $event
 * @property User $manageBy
 * @property Speakers $speaker
 * @property User $updatedBy
 * @property GeneralCategory $category
 * @property GeneralVendor $vendor
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
            [['speaker_id', 'event_id', 'category_id', 'vendor_id', 'category_item', 'category_item_qty', 'manage_by', 'updated_by'], 'required'],
            [['speaker_id', 'event_id', 'category_id', 'vendor_id', 'manage_by', 'updated_by'], 'integer'],
            [['category_item', 'category_item_qty'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Events::className(), 'targetAttribute' => ['event_id' => 'id']],
            [['manage_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['manage_by' => 'id']],
            [['speaker_id'], 'exist', 'skipOnError' => true, 'targetClass' => Speakers::className(), 'targetAttribute' => ['speaker_id' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['vendor_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralVendor::className(), 'targetAttribute' => ['vendor_id' => 'id']],
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
            'category_id' => 'Category ID',
            'vendor_id' => 'Vendor ID',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(GeneralCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVendor()
    {
        return $this->hasOne(GeneralVendor::className(), ['id' => 'vendor_id']);
    }
}
