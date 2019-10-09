<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property int $id
 * @property string $visitor_name
 * @property string $visitor_uid
 * @property string $created_at
 * @property int $updated_by
 */
class Visitors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['visitor_name', 'visitor_uid', 'updated_by'], 'required'],
            [['created_at'], 'safe'],
            [['updated_by'], 'integer'],
            [['visitor_name', 'visitor_uid'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'visitor_name' => 'Visitor Name',
            'visitor_uid' => 'Visitor Uid',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
        ];
    }
}
