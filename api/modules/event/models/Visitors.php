<?php

namespace api\modules\event\models;

use Yii;

/**
 * This is the model class for table "visitors".
 *
 * @property int $id
 * @property int $user_id
 * @property string $visitor_uid
 * @property string $gender Male, Female, Other
 * @property string $birthdate
 * @property string $created_at
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property Visitors $user
 * @property Visitors[] $visitors
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
            [['user_id', 'visitor_uid', 'gender', 'birthdate', 'updated_by'], 'required'],
            [['user_id', 'updated_by'], 'integer'],
            [['birthdate', 'created_at', 'updated_at'], 'safe'],
            [['visitor_uid'], 'string', 'max' => 255],
            [['gender'], 'string', 'max' => 20],
            //[['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Visitors::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'visitor_uid' => 'Visitor Uid',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        //return $this->hasOne(Visitors::className(), ['id' => 'user_id']);
        return $this->hasOne(User::className(), ['id' => 'user_id']);  
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVisitors()
    {
        return $this->hasMany(Visitors::className(), ['user_id' => 'id']);
    }
}
