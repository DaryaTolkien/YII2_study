<?php
namespace app\models;

use Yii;
use yii\base\Model;

class Activity extends Model{ //Отражает сущность хранимого в календаре события
	
	public $title; //название события
	public $starDay; //начало события
	public $endDay; //конец события
	public $idAuhtor; //id автора события
	public $body; //описание события
	
	public function attributeLabels(){
		return[
			'title' => 'Название события',
			'startDay' => 'Дата начала',
            'endDay' => 'Дата завершения',
            'idAuthor' => 'ID автора',
            'body' => 'Описание события'
		];
	}

	
}