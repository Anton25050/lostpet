<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "status".
 *
 * @property int $id
 * @property string $status
 *
 * @property PetRequests[] $petRequests
 */
class Status extends \yii\db\ActiveRecord
{

    const NEW_STATUS_ID = 1;
    const APPROVED_STATUS_ID = 2;
    const DECLINED_STATUS_ID = 3;
    const FOUNDED_STATUS_ID = 4;
    const NOTFOUNDED_STATUS_ID = 5;

    public function __toString()
    {
        return $this->name;
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'required'],
            [['status'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[PetRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPetRequests()
    {
        return $this->hasMany(Pet_Requests::class, ['status_id' => 'id']);
    }
}
