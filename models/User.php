<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id_u
 * @property string $token
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
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id_u)
    {
        return static::findOne($id_u);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id_u;
    }

    public function getAuthKey()
    {
        return;
    }

    public function validateAuthKey($authKey)
    {
        return;
    }
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
    public function fields()
    {
        $fields = parent::fields();
// удаляем небезопасные поля
        unset($fields['password'],);
        return $fields;
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
