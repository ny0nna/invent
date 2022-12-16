<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "doc".
 *
 * @property int $id_doc
 * @property int $id_u
 * @property string $name
 *
 * @property User $u
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_u'], 'integer'],
            [['name'], 'file'],
            [['id_u'], 'unique'],
            [['id_u'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_u' => 'id_u']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_doc' => 'Id Doc',
            'id_u' => 'Id U',
            'name' => 'Name',
        ];
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

    public function beforeValidate(){
        $this->name=UploadedFile::getInstanceByName('name');
        return parent::beforeValidate();
    }
}
