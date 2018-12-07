<?php
namespace app\components;
	
class MessengerComponent extends Component{
	public $message;
	
	public function init(){
		parent::init();
		$this->message = 'text';
	}
	
	public function display($userMessage){
		$this->message = $userMessage;
		
		return Html::encode($this->message);
	}
}