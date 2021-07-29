<?php
class CLsystem {
    function checkmes($arr){
		//echo "<pre>";print_r($arr);exit;
		if (isset($arr['message'])){
			$mas=array(
				'date' 			=> $arr['message']['date'],
				'message_id'	=> $arr['message']['message_id'],
				'from_uid'		=> $arr['message']['from']['id'],//$CLuser->_userInfo['id'],
				'chat_id'		=> $arr['message']['chat']['id'],
				'chat_type'		=> $arr['message']['chat']['type'],
				'text'			=> $arr['message']['text'],
				'type'			=> 'message',
				'first_name'	=> $arr['message']['from']['first_name'],
				'last_name'		=> $arr['message']['from']['last_name'],
				'username'		=> $arr['message']['from']['username'],
				'is_bot'		=> $arr['message']['from']['is_bot'],
				'set_button'	=> '',
			);
		}
		// если это нажатие кнопки
		elseif (isset($arr['callback_query'])){
			$rr=$arr['callback_query'];
			$mas=array(
				'date' 			=> $rr['message']['date'],
				'message_id'	=> $rr['message']['message_id'],
				'from_uid'		=> $rr['from']['id'],
				'chat_id'		=> $rr['message']['chat']['id'],
				'chat_type'		=> $rr['message']['chat']['type'],
				'text'			=> $rr['message']['text'],
				'type'			=> 'callback',
				'set_button'	=> $rr['data'],
				'first_name'	=> $rr['from']['first_name'],
				'last_name'		=> $rr['from']['last_name'],
				'username'		=> $rr['from']['username'],
				'is_bot'		=> $rr['from']['is_bot'],
			);
		}
		//echo "<pre>";print_r($mas);exit;
		return $mas;
	}
	function set_log($arr){
		global $CLmysql,$CLuser;
		$CLmysql->dbconnect('real');
		$link=$CLmysql->_linkdb;
		
		$mas=array(
			'date' 			=> $arr['date'],
			'message_id'	=> $arr['message_id'],
			'from_uid'		=> $arr['from_uid'],
			'chat_id'		=> $arr['chat_id'],
			'chat_type'		=> $arr['chat_type'],
			'text'			=> $arr['text'],
			'type'			=> $arr['type'],
			'set_button'	=> $arr['set_button']
		);
		
		$CLmysql->insert($mas,'logs');
	}
	function save_log($text,$fold='get'){
		$file = $_SERVER['DOCUMENT_ROOT'].'/logs/'.$fold.'_bot_'.date('d-m-Y-H:i:s').'.txt';
		file_put_contents($file, $text);
	}
}


$CLsys=new CLsystem();


?>