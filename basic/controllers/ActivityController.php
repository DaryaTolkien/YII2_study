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
	    return $this->render('index', ['model' => $model]);
	}
	
	public function actionForm(){
    $model = new \app\models\ActivityForm();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {
            // form inputs are valid, do something here
            return $this->redirect(['success']);
        }
    }
    return $this->render('form', [
        'model' => $model,
    ]);
    }
	
	public function actionSuccess(){
		echo "All good! Successs!";
		exit();
	}
	
}