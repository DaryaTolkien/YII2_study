<?php

namespace app\controllers;

use Yii;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\signupForm;

class SiteController extends Controller
{
	
	 public $rememberMe = true;
    
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions(){
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }


    public function actionIndex(){
        return $this->render('index');
    }
/*
    
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

*/
	public function actionSignup(){
		if(!Yii::$app->user->isGuest){
			return $this->goHome(); 
		}
		$model = new signupForm();
		if($model->load(Yii::$app->request->post()) && $model->validate()){
			$user = new User();
			$user->username = $model->username;
			$user->password = $user->setPassword($model->password);//Yii::$app->security->generatePasswordHash($model->password);//
			if($user->save() && Yii::$app->user->login($user->findByUsername($user->username), $this->rememberMe ? 3600*24*30 : 0)){
				return $this->goHome();
			} else {
				return $user->error;
			}
			
		}
		return $this->render('signup', ['model' => $model] );
	}

     public function actionLogin(){
       if (!Yii::$app->user->isGuest){
            return $this->goHome();
        }
		 
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()){
				return $this->goBack();
			} 
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);	 
    }
	
	
    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionContact(){
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted'); 

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
	
}













