<?php
namespace app\controllers;

use Yii;
use yii\web\controller;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

use yii\filters\AccessControl;
use app\models\ActivityDAO;
use app\models\User;
use app\models\Activity_bd;
use app\models\signupForm;




class ActivityController extends Controller{
	
	public function behaviors(){
		return[
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['form'],
				'rules' => [
					[
						'actions' => ['form'],
						'allow' => true,
						'roles' => ['admin', 'simple'],
					],
				],
			],
		];
	}
	
	public function actionSignup(){
		if(!Yii::$app->user->isGuest){
			return $this->goHome(); 
		}
		$model = new signupForm();
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			$user = new User();
			$user->username = $model->username;
			$user->password = Yii::$app->security->generatePasswordHash($model->password);//$user->setPassword($model->password);
			if($user->save()){
				return $this->goHome();
			} else {
				return $user->error;
			}
			
		}
		return $this->render('signup', ['model' => $model] );
	}
	
	
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
		    $model->imageFile = UploadedFile::getInstance($model, 'imageFile'); // добавляем картинку на сервер
        if ($model->validate()) {  //Если все верно и валидно, то принимаем и обрабатываем данные
			          $model->id_user = Yii::$app->user->id;
			          $path = Yii::$app->params['pathUploads']; //путь для картинки
                      $model->imageFile->saveAs($path . $model->imageFile->baseName . '.' . $model->imageFile->extension); //Сохраняем картинку
			
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