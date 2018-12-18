<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class RbacController extends Controller{
	
	public function actionInit(){
		$role = Yii::$app->authManager->createRole('admin');
		$role->description = 'Администратор';
		Yii::$app->authManager->add($role);
		
		$role = Yii::$app->authManager->createRole('simple');
		$role->description = 'Пользователь';
		Yii::$app->authManager->add($role);
		
	}
	
	public function actionAssign($role, $userId){
		$modelRole = Yii::$app->authManager->getRole($role);
		if(is_null($modelRole)){
			Console::error("Model role {$role} not found");
		}
		
		Yii::$app->authManager->assign($modelRole, $userId);
	}
	
}
