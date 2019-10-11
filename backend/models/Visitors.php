<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property int $id
 * @property string $visitor_name
 * @property string $visitor_uid
 * @property string $gender Male, Female, Other
 * @property string $birthdate
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
            [['visitor_name', 'visitor_uid', 'gender', 'birthdate', 'updated_by'], 'required'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['updated_by'], 'integer'],
            [['visitor_name', 'visitor_uid'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 20],
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
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
        ];
    }
}
