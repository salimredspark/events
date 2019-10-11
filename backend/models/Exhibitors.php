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
 * @property string $gender Male, Female, Other
 * @property string $birthdate
 * @property string $company_name
 * @property string $company_site_url
 * @property string $company_address
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
            [['firstname', 'lastname', 'username', 'gender', 'birthdate', 'company_name', 'company_site_url', 'company_address', 'updated_by'], 'required'],
            [['birthdate', 'updated_at', 'password_has'], 'safe'],
            [['company_address'], 'string'],
            [['updated_by'], 'integer'],
            [['firstname', 'lastname', 'username', 'password_has', 'company_name', 'company_site_url'], 'string', 'max' => 255],
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
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'username' => 'Username',
            'password_has' => 'Password Has',
            'gender' => 'Gender',
            'birthdate' => 'Birthdate',
            'company_name' => 'Company Name',
            'company_site_url' => 'Company Site Url',
            'company_address' => 'Company Address',
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
