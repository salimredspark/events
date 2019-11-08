<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "general_category".
 *
 * @property int $id
 * @property string $category_name
 * @property string $category_detail
 * @property int $updated_by
 *
 * @property User $updatedBy
 * @property GeneralVendor[] $generalVendors
 */
class GeneralCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'general_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_name', 'category_detail', 'updated_by'], 'required'],
            [['category_detail'], 'string'],
            [['updated_by'], 'integer'],
            [['category_name'], 'string', 'max' => 255],
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
            'category_name' => 'Category Name',
            'category_detail' => 'Category Detail',
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
    public function getGeneralVendors()
    {
        return $this->hasMany(GeneralVendor::className(), ['category_id' => 'id']);
    }
}
