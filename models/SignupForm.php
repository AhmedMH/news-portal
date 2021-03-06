<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $name
 * @property string $email
 */
class SignupForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email'], 'required'],
            [['name', 'email'], 'string', 'max' => 50],
            ['email','email'],
            ['email', 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
        ];
    }
}
