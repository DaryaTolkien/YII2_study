<?php
namespace app\controllers;

use Yii;
use yii\web\controller;
use app\models\Activity;
use app\models\Day;
use yii\web\Response;

class ActivityController extends Controller{
	
	public function actionIndex(){
		$model = new Day();
		$model->setWeekday();
		$model->setHour();
		$model->setSeconds();
		return $this->render('day', ['model' => $model]);
	}
	
	public function actionCreate(){
		$model = new Activity();
	    return $this->render('view', ['model' => $model]);
	}
	
}