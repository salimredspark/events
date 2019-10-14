<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "exhibitors".
 *
 * @property int $id
 * @property int $user_id
 * @property string $gender Male, Female, Other
 * @property string $birthdate
 * @property string $company_name
 * @property string $company_site_url
 * @property string $company_address
 * @property string $updated_at
 * @property string $created_at
 * @property int $updated_by
 *
 * @property User $user
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
            [['user_id', 'gender', 'birthdate', 'company_name', 'company_site_url', 'company_address', 'updated_by'], 'required'],
            [['user_id', 'updated_by'], 'integer'],
            [['birthdate', 'updated_at', 'created_at'], 'safe'],
            [['company_address'], 'string'],
            [['gender'], 'string', 'max' => 20],            
            [['company_name', 'company_site_url'], 'string', 'max' => 255],
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
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'company_name' => 'Company Name',
            'company_site_url' => 'Company Site Url',
            'company_address' => 'Company Address',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIsEventExhibitors()
    {
        return $this->hasMany(IsEventExhibitors::className(), ['exhibitor_id' => 'id']);
    }
}
