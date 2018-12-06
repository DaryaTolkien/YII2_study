<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Day extends Model{
	public $weekday; //день недели
	public $hours; //часы день/ночь
	public $seconds;
	
	public static function getData($value){
		$lol = getdate( time() );
		return $lol["$value"];
	}
	public function setSeconds(){
	  return $this->seconds = self::getData('minutes');
	}
	
	public function setWeekday(){
	   return $this->weekday = self::getData('weekday');
	}
	public function setHour(){
	  return $this->hours = self::getData('hours');
	}
}
