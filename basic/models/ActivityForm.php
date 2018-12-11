<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ActivityForm extends Model{
	public $name;
	public $description;
	public $dateTimeStart;
	public $dateTimeAnd;
	public $imageFile;
	public $isBlock = false;
	
	public function rules(){
		return [
			[['name', 'description'], 'required'],
			['isBlock', 'boolean'],
			[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
		];
	}
	/*
	public function upload(){
        if ($this->validate()) {
			$path = Yii::$app->params['pathUploads'];
            $this->imageFile->saveAs($path . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }*/
}