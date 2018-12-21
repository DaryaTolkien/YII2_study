<?php


namespace app\models;
use Yii;
use yii\base\Model;

class SignupForm extends Model{ 

    public $username;
    public $password;
 
   public function rules() {
      return [
      [['username', 'password'], 'required', 'message' => 'Заполните поле'],
	  ['username', 'string', 'min' => 2, 'max' => 50, 'message' => 'Имя должно быть больше 2 символов, и меньше 50'],
      ['username', 'unique', 'targetClass' => User::className(),  'message' => 'Этот логин уже занят'],
     ];
    }
 
    public function attributeLabels() {
       return [
       'username' => 'Логин',
       'password' => 'Пароль',
     ];
   }
	
}
 
