<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exhibitors".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $username
 * @property string $password_has
 * @property string $updated_at
 * @property int $updated_by
 *
 * @property IsEventExhibitors[] $isEventExhibitors
 */
class Exhibitors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exhibitors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname', 'username', 'updated_by'], 'required'],
            [['updated_at', 'password_has'], 'safe'],
            [['updated_by'], 'integer'],
            [['firstname', 'lastname', 'username'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password_has' => 'Password Has',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsEventExhibitors()
    {
        return $this->hasMany(IsEventExhibitors::className(), ['exhibitor_id' => 'id']);
    }
}
