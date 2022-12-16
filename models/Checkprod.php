<?php

namespace app\models;

use Yii;
use Yii\web\IdentityInterface;
/**
 * This is the model class for table "check_prod".
 *
 * @property int $id_ch
 * @property int $id_t
 * @property int $id_u
 * @property string $date_start
 * @property string $date_end
 * @property int|null $num
 *
 * @property Product $t
 * @property User $u
 */
class Checkprod extends \yii\db\ActiveRecord implements IdentityInterface
{
    public static function findIdentity($id_ch)
    {
        return static::findOne($id_ch);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id_ch;
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
        return 'checkprod';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_t', 'id_u','date_start', 'date_end', 'num'], 'required'],
            [['id_t', 'id_u', 'num'], 'integer'],
            [['date_start', 'date_end'], 'string'],
            [['id_t'], 'unique'],
            [['id_u'], 'unique'],
            [['id_t'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['id_t' => 'id_t']],
            [['id_u'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_u' => 'id_u']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ch' => 'Id Ch',
            'id_t' => 'Id T',
            'id_u' => 'Id U',
            'date_start' => 'Date Start',
            'date_end' => 'Date End',
            'num' => 'Num',
        ];
    }

    /**
     * Gets query for [[T]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getT()
    {
        return $this->hasOne(Product::className(), ['id_t' => 'id_t']);
    }

    /**
     * Gets query for [[U]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getU()
    {
        return $this->hasOne(User::className(), ['id_u' => 'id_u']);
    }

}
