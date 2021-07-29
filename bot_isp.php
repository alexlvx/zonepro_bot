<?
define('TGKEY', '1781232884:AAEdjLso8u9maYpfRN1dR8CJPfI6QkXihao');
//  - API KEY
include ($_SERVER['DOCUMENT_ROOT'].'/core/class/class.php');


function save_log($text,$fold='get'){
	$file = $_SERVER['DOCUMENT_ROOT'].'/logs/'.$fold.'_bot_'.date('d-m-Y-H:i:s').'.txt';
	file_put_contents($file, $text);
}


$body = file_get_contents('php://input');
save_log($body);

$arr = json_decode($body, true); 
// id сообщения, на которое нужно отреагировать


$tg = new tg(TGKEY);
if (isset($arr['message'])) {
	$tg_id = $arr['message']['chat']['id'];
	$mesid=$arr['message']['message_id'];
}
elseif (isset($arr['channel_post'])) {
	$tg_id = $arr['channel_post']['chat']['id'];
	$mesid=$arr['channel_post']['message_id'];
}



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