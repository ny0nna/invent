<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id_u
 * @property string|null $token
 * @property string $login
 * @property string $first_name
 * @property string $last_name
 * @property string|null $otchestvo
 * @property string $email
 * @property int $phone
 * @property string $password
 * @property int $age
 * @property string $pol
 *
 * @property CheckProd $checkProd
 * @property Doc $doc
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
            [['login', 'first_name', 'last_name', 'email', 'phone', 'password', 'age', 'pol'], 'required'],
            [['phone', 'age'], 'integer'],
            [['pol'], 'string'],
            [['token'], 'string', 'max' => 100],
            [['login', 'first_name', 'last_name', 'otchestvo'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 70],
            [['password'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_u' => 'Id U',
            'token' => 'Token',
            'login' => 'Login',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'otchestvo' => 'Otchestvo',
            'email' => 'Email',
            'phone' => 'Phone',
            'password' => 'Password',
            'age' => 'Age',
            'pol' => 'Pol',
        ];
    }

    /**
     * Gets query for [[CheckProd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckProd()
    {
        return $this->hasOne(CheckProd::className(), ['id_u' => 'id_u']);
    }

    /**
     * Gets query for [[Doc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDoc()
    {
        return $this->hasOne(Doc::className(), ['id_u' => 'id_u']);
    }
}
