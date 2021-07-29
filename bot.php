<?
include ($_SERVER['DOCUMENT_ROOT'].'/core/loader.php');


$body = file_get_contents('php://input');
$CLsys->save_log($body);

$arr = json_decode($body, true); 
//echo "<pre>";print_r($arr);exit;
$arr=$CLsys->checkmes($arr);

$tg_id = $arr['chat_id'];
$mesid=$arr['message_id'];
$uid=$arr['from_uid'];


$rez_kb='';

// получаем пользователя.. 
$user=$CLuser->getUser($uid,$arr);



// сохраняем сообщение пользователя(логируем)
$CLsys->set_log($arr);
//exit('11111111111');

$mes="<h1>test</h1>";
//$x1 = array("text"=>"Начать работать","callback_data"=>"go");
//$x2 = array("text"=>"Прекратить быть менеджером","callback_data"=>"exit");
//$x3 = array("text"=>"Статистика","callback_data"=>"exit");
//$x4 = array("text"=>"Баланс","callback_data"=>"exit");
$rez_kb = [];//[$x1,$x2],[$x3,$x4]];

$tg->send($tg_id, $mes, $rez_kb,$mesid);
exit('ok');






if ($arr['set_button']=='back_s1') {
	$mesedit=1;
	$arr['set_button']='';
}
if ($arr['set_button']=='back_s2_menisp') {
	$mesedit=1;
	$arr['set_button']='menisp';
}

// если у пользователя нет роли..
if ($CLuser->_userInfo['role']==''){
	$CLuser->setrole($arr);
}

switch($CLuser->_userInfo['role']){
	case 'menisp' : $CLwmenisp->work($arr); break;
}




exit('OK!!');

$tg->send($tg_id, $uid, $rez_kb,$mesid);
exit('ok'); // говорим телеге, что все окей
echo "<pre>";print_r($arr);exit;








//$tg_id=213872332;
  
$x1 = array("text"=>"First Button","callback_data"=>"test1");
$x2 = array("text"=>"Second Button","callback_data"=>"test2");
$rez_kb = [[$x1,$x2],[$x1,$x1]]; // два ряда инлайн кнопок


$message_text = $arr['message']['text'];
//$tg->sendChatAction($tg_id);
$sms_rev=date('d-m-y H:i:s').' - привет, это тест! - '.$tg_id;

echo $sms_rev."<Br>";

/*	
	switch($message_text){
		case '/start':
			$sms_rev = 'Здравствуйте, Вас приветсвует Простейший Бот Telegram!
';
		break;
		case '/help':
			$sms_rev = 'Я могу выполнить следующюю функцию:
			/rev - переворачиваею строку наоборот.
';	
		break;	

		case '/rev':
			$sms_rev = strrev($message_text);	
		break;	

		default:
			$sms_rev ='Команда не распознана';
		break;	
	}
*/
$tg->send($tg_id, $sms_rev, $rez_kb,$mesid);
exit('ok'); // говорим телеге, что все окей



?>