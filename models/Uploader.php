<?php

namespace app\models;

use Yii;
use yii\base\Model;

class Uploader extends Model
{
    public $imageFile;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg','maxSize' => 1024 * 1024 * 2],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'imageFile' => 'Image File'
        ];
    }

     public function upload($id)
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/article_' . $id . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

}
