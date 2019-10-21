<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "general_vendor".
 *
 * @property int $id
 * @property int $category_id
 * @property string $vendor_name
 * @property string $vendor_website
 * @property string $vendor_detail
 * @property int $updated_by
 *
 * @property GeneralCategory $category
 * @property User $updatedBy
 */
class GeneralVendor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general_vendor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'vendor_name', 'vendor_detail', 'updated_by'], 'required'],
            [['category_id', 'updated_by'], 'integer'],
            [['vendor_detail', 'vendor_website'], 'string'],
            [['vendor_name', 'vendor_website'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => GeneralCategory::className(), 'targetAttribute' => ['category_id' => 'id']],
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
            'category_id' => 'Category ID',
            'vendor_name' => 'Vendor Name',
            'vendor_website' => 'Vendor Website',
            'vendor_detail' => 'Vendor Detail',
            'updated_by' => 'Updated By',
        ];
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
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }
}
