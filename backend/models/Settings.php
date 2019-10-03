<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property int $id
 * @property string $setting_key
 * @property string $setting_value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['setting_key', 'setting_value'], 'required'],
            [['setting_value'], 'string'],
            [['setting_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'setting_key' => 'Setting Key',
            'setting_value' => 'Setting Value',
        ];
    }
}
