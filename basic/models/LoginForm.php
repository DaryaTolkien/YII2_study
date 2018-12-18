<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;


class LoginForm extends Model{
    public $username;
    public $password;
    public $rememberMe = true;
	public $password_hash;

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
			if($this->getUser($user)){
				
			//$hash = Yii::$app->security->generatePasswordHash($this->password);
				$hash = new User();
				//if(Yii::$app->security->validatePassword($this->password, $hash)){
				$lol = $hash->setPassword($this->password);
				if($hash->validatePassword($this->password)){
					return true;
				} else {
					$this->addError($attribute, 'Неправильный пароль');
				}
			} else {
				$this->addError($attribute, 'Такого логина не существует.');
			}
        }
     }

/*
    public function validatePassword($attribute, $params){
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неправильный логин или пароль');
            }
        }
    }
*/

    public function login(){
        //if ($this->validate()) {
        //    return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
       // }
        //return false;
		if ($this->validate()){
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }
	
	
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}






