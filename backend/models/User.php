<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 * @property int $updated_by
 * @property string $firstname
 * @property string $lastname
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'firstname', 'lastname'], 'required'],
            //[['status', 'created_at', 'updated_at', 'updated_by'], 'integer'],
            [['username', 'password_hash', 'email', 'email', 'firstname', 'lastname'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['firstname', 'lastname'], 'string', 'max' => 150],
            [['username'], 'unique'],
            [['email'], 'unique'],
            //[['password_reset_token'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'updated_by' => 'Updated By',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
        ];
    }
}
