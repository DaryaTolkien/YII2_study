<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ActivityForm extends Model{
	public $activity_name;
	public $body;
	public $activity_start_timestamp;
	public $activity_end_timestamp;
	public $imageFile;
	public $id_user;
	public $isBlock = false;
	
	public function rules(){
		return [
			[['activity_name', 'body','activity_start_timestamp','activity_end_timestamp'], 'required'],
			['isBlock', 'boolean'],
			[['id_user'], 'integer'],
			[['activity_start_timestamp', 'activity_end_timestamp'], 'date', 'format' => 'php:Y-m-d'],
			[['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg']
		];
	}
	
}