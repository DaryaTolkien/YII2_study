<?php
namespace app\controllers;

use Yii;
use yii\web\controller;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use app\models\ActivityDAO;
use app\models\User;
use app\models\Activity_bd;





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
						'roles' => ['@'],
					],
					[
						'actions' => ['admin'],
						'allow' => true,
						'roles' => ['guest'],
					],
				],
			],
		];
	}
	
	public function actionAdmin(){
		$query = Activity_bd::find();
		$activitiesProvider = new ActiveDataProvider([
          'query' => $query,
          'pagination' => [
                 'pageSize' => 5,
           ],
           'sort' => [
                'defaultOrder' => [
                'id_activity' => SORT_DESC,
           ]
          ],
]);

		return $this->render('admin', ['activitiesProvider' => $activitiesProvider]);
	}
	
	public function actionEvent(){
		$id = $_GET['id'];
		$list = Activity_bd::find()
        ->where(['id_activity' => $id])
        ->one();
		if(is_null($list)){
			throw new HttpException(404);
		}
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