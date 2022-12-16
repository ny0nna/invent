<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "product".
 *
 * @property int $id_t
 * @property string $t_name
 * @property string $date_start
 * @property string $date_end
 * @property int $num
 *
 * @property CheckProd $checkProd
 */
class Product extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id_t)
{
    return static::findOne($id_t);
}

    public static function findIdentityByAccessToken($token, $type = null)
{
    return static::findOne(['token' => $token]);
}

    public function getId()
{
    return $this->id_t;
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
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_name', 'date_start', 'date_end', 'num'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['num'], 'integer'],
            [['t_name'], 'string', 'max' => 100],
        ];
    }
   /* public function fields()
    {
        return [
            't_name',
            'date_start',
            'date_end',
            'num',
        ];
    }*/
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_t' => 'Id T',
            't_name' => 'T Name',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'num' => 'Num',
        ];
    }

    /**
     * Gets query for [[CheckProd]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckProd()
    {
        return $this->hasOne(CheckProd::className(), ['id_t' => 'id_t']);
    }
}
