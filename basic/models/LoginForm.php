<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


class LoginForm extends Model{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    public function rules(){
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }
    
   public function attributeLabels() {
       return [
       'username' => 'Имя',
       'password' => 'Пароль',
	   'rememberMe' => 'Запомнить меня',
     ];
   }
	
	public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
          
			$user = $this->username;
			if($lol = $this->getUser($user)){
				//if(!$lol || !$lol->validatePassword($this->password, $lol->password_hash)){//Yii::$app->security->validatePassword($this->password, $lol->password_hash)){
				$test = Yii::$app->security->generatePasswordHash($this->password);
				if(!$lol || !Yii::$app->security->validatePassword($test, $lol->password_hash)){
					$this->addError($attribute, 'Неправильный пароль');
				} else {
					return true;
				}
			} else {
				$this->addError($attribute, 'Такого логина не существует.');
			}
        }
     }
/*
    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
            $user = $this->getUser($this->username);

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный логин или пароль');
            }
        }
    }
*/

    public function login(){
		if ($this->validate()){
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
	
	
    public function getUser(){
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
	
}







	
	
	
	
	
	
	
	
	
	
	
	