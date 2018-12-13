<?php
namespace app\models;
use Yii;

class ActivityDAO{
	
	private $table = "activity_bd";
		
	public function create($activity){
		
		$db = Yii::$app->db;
		$result = $db->createCommand()->insert($this->table, [
			'activity_name' => $activity->activity_name,
			'activity_start_timestamp' => $activity->activity_start_timestamp,
			'activity_end_timestamp' => $activity->activity_end_timestamp,
			'imageFile' => $activity->imageFile,
			'body' => $activity->body,
			'id_user' => $activity->id_user
		])->execute();
		
		return $result > 0;
	}
}