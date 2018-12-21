<?php

namespace app\models;
use yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $role
 * @property string $name
 * @property string $surname
 * @property string $middle_name
 * @property string $password write-only password
 * @property string $salt
 * @property string $access_token
 * @property string $create_date
 */

class User extends ActiveRecord implements IdentityInterface{
   
	 public function attributeLabels() {
      return [
      'id' => 'id',
	  'username' => 'username',
      'email' => 'email',
      'password_hash' => 'password_hash',
      'auth_key' => 'auth_key',
      'created_at' => 'created_at',
      'updated_at' => 'updated_at',
    ];
  }

	
    public static function findIdentity($id){
        return static::findOne(['id' => $id]);
    }


    public static function findIdentityByAccessToken($token, $type = null){

        return null;
    }

    public static function findByUsername($username){
       return static::findOne(['username' => $username]);
    }

	
    public function getId(){
        return $this->getPrimaryKey();
    }
 
	
    public function getAuthKey(){
        return $this->auth_key;
    }

	
    public function validateAuthKey($auth_key){
        return $this->getAuthKey === $auth_key;
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
	
	public function setPassword($password){
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}
	
	public function generateAuthKey(){
		$this->auth_key = Yii::$app->security->generateRandomString();
	}
}














