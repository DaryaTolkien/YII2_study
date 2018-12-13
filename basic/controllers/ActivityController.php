<?php
namespace app\controllers;

use Yii;
use yii\web\controller;
use app\models\ActivityDAO;
use app\models\Activity_bd;
use yii\web\UploadedFile;



class ActivityController extends Controller{
	
	
	public function actionEvent(){
		$id = $_GET['id'];
		$list = Activity_bd::find()
        ->where(['id_activity' => $id])
        ->one();
		return $this->render('event', ['list' => $list]);
	}
	
	public function actionForm(){
    $model = new \app\models\ActivityForm();

    if ($model->load(Yii::$app->request->post())) {
		    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
        if ($model->validate()) {  //Если все верно и валидно, то принимаем и обрабатываем данные
			        $path = Yii::$app->params['pathUploads'];
                    $model->imageFile->saveAs($path . $model->imageFile->baseName . '.' . $model->imageFile->extension);
			    $activityDAO = new ActivityDAO();
			    $activityDAO->create($model);
			
		$list = Activity_bd::find()->orderBy('id_activity')->all();
		return $this->render('calendar', ['list' => $list]);
        }
    }
    return $this->render('form', [
        'model' => $model,
    ]);
    }
	
	public function actionCalendar(){
		$list = Activity_bd::find()->orderBy('id_activity')->all();
		return $this->render('calendar', ['list' => $list]);
	}
	
}