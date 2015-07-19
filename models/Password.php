<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Password extends Model
{
    public $password;
    public $confirm_password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['password','confirm_password'], 'required'],
            [['password','confirm_password'], 'string', 'max' => 100],
            ['confirm_password', 'compare', 'compareAttribute'=>'password'],
            ['confirm_password','safe']

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Password',
            'confirm_password' => 'Confirm Password'
        ];
    }

}
