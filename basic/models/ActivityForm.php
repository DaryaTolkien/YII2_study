<?php
namespace app\models;

use Yii;
use yii\base\Model;

class ActivityForm extends Model{
	public $name;
	public $description;
	public $dateTimeStart;
	public $dateTimeAnd;
	public $isBlock = false;
	
	public function rules(){
		return [
			[['name', 'description'], 'required'],
			[['dateTimeStart', 'dateTimeAnd'], 'date'],
			['isBlock', 'boolean']
		];
	}
}