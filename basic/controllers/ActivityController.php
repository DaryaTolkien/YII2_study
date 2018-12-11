<?php
namespace app\controllers;

use Yii;
use yii\web\controller;
use app\models\ActivityEvent;
use app\models\Day;
use yii\web\Response;

class ActivityController extends Controller{
	
	
	public function actionEvent(){
		$model = new ActivityEvent();
	    return $this->render('event', ['model' => $model]);
	}
	
	public function actionForm(){
    $model = new \app\models\ActivityForm();

    if ($model->load(Yii::$app->request->post())) {
        if ($model->validate()) {  //Если все верно и валидно, то принимаем и обрабатываем данные
			
			return $this->render('form-success', ['model' => $model]);
        }
    }
    return $this->render('form', [
        'model' => $model,
    ]);
    }
	
	public function actionCalendar(){
		return $this->render('calendar', ['model' => $model]);
	}
	
}