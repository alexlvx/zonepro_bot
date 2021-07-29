<?
include ($_SERVER['DOCUMENT_ROOT'].'/core/loader.php');


function save_log($text,$fold='get'){
	$file = $_SERVER['DOCUMENT_ROOT'].'/logs/'.$fold.'_bot_'.date('d-m-Y-H:i:s').'.txt';
	file_put_contents($file, $text);
}

$data='{"update_id":906674871,
"callback_query":{"id":"918574674343231570","from":{"id":213872332,"is_bot":false,"first_name":"Wp","last_name":"Clip","username":"wpclip","language_code":"ru"},"message":{"message_id":149,"from":{"id":1781232884,"is_bot":true,"first_name":"zonepro","username":"ZonePro_bot"},"chat":{"id":213872332,"first_name":"Wp","last_name":"Clip","username":"wpclip","type":"private"},"date":1618077788,"edit_date":1618077804,"reply_to_message":{"message_id":140,"from":{"id":1781232884,"is_bot":true,"first_name":"zonepro","username":"ZonePro_bot"},"chat":{"id":213872332,"first_name":"Wp","last_name":"Clip","username":"wpclip","type":"private"},"date":1617032422,"edit_date":1617062149,"text":"\u041c\u0435\u043d\u0435\u0434\u0436\u0435\u0440 \u043f\u043e \u0440\u0430\u0431\u043e\u0442\u0435 \u0441 \u0438\u0441\u043f\u043e\u043b\u043d\u0438\u0442\u0435\u043b\u044f\u043c\u0438, \u043e\u0442\u0432\u0435\u0447\u0430\u0435\u0442 \u0437\u0430 \u043f\u0440\u0438\u0432\u043b\u0435\u0447\u0435\u043d\u0438\u0435 \u043d\u043e\u0432\u044b\u0445 \u0441\u043f\u0435\u0446\u0438\u0430\u043b\u0438\u0441\u0442\u043e\u0432. \u042f \u043f\u043e\u043c\u043e\u0433\u0443 \u0440\u0430\u0437\u043e\u0431\u0440\u0430\u0442\u044c\u0441\u044f \u0432 \u0434\u0435\u0442\u0430\u043b\u044f\u0445, \u0434\u0430\u0432\u0430\u044f \u043f\u043e\u0448\u0430\u0433\u043e\u0432\u0443\u044e \u0438\u043d\u0441\u0442\u0440\u0443\u043a\u0438\u0446\u044e! \u041d\u0435 \u0442\u0440\u0435\u0431\u0443\u044e\u0442\u0441\u044f \u043a\u0430\u043a\u0438\u0435 \u0442\u043e \u0441\u043f\u0435\u0446 \u043d\u0430\u0432\u044b\u043a\u0438!","reply_markup":{"inline_keyboard":[[{"text":"\u041d\u0430\u0447\u0430\u0442\u044c \u0440\u0430\u0431\u043e\u0442\u0430\u0442\u044c!","callback_data":"s3_menisp"}],[{"text":"\u041d\u0430\u0437\u0430\u0434","callback_data":"back_s2_menisp"}]]}},"text":"\u042d\u0442\u043e \u0433\u043b\u0430\u0432\u043d\u044b\u0439 \u044d\u043a\u0440\u0430\u043d \u043c\u0435\u043d\u0435\u0434\u0436\u0435\u0440\u0430 \u043f\u043e \u0438\u0441\u043f\u043e\u043b\u043d\u0438\u0442\u0435\u043b\u044f\u043c. \u0422\u0443\u0442 \u0432\u044b \u043c\u043e\u0436\u0435\u0442\u0435 \u0443\u0437\u043d\u0430\u0442\u044c \u0441\u0432\u043e\u0439 \u0431\u0430\u043b\u0430\u043d\u0441, \u0441\u0442\u0430\u0442\u0438\u0441\u0442\u0438\u043a\u0443 \u0438 \u0434\u0440\u0443\u0433\u043e\u0435.","reply_markup":{"inline_keyboard":[[{"text":"\u041d\u0430\u0447\u0430\u0442\u044c \u0440\u0430\u0431\u043e\u0442\u0430\u0442\u044c","callback_data":"go"},{"text":"\u041f\u0440\u0435\u043a\u0440\u0430\u0442\u0438\u0442\u044c \u0431\u044b\u0442\u044c \u043c\u0435\u043d\u0435\u0434\u0436\u0435\u0440\u043e\u043c","callback_data":"exit"}],[{"text":"\u0421\u0442\u0430\u0442\u0438\u0441\u0442\u0438\u043a\u0430","callback_data":"exit"},{"text":"\u0411\u0430\u043b\u0430\u043d\u0441","callback_data":"exit"}]]}},"chat_instance":"-3238648729261695725","data":"go"}}';

$data=json_decode($data,true);


$data_string = json_encode ($data, JSON_UNESCAPED_UNICODE);
$curl = curl_init('https://tg.ga14.ru/bot.php');
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
   'Content-Type: application/json',
   'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($curl);
curl_close($curl);


echo '<pre>';
print_r($result);
exit;









get_page(json_encode($d));
exit;






$body = file_get_contents('php://input');
save_log($body);

$arr = json_decode($body, true); 

$tg = new tg(TGKEY);
if (isset($arr['message'])) {
	$tg_id = $arr['message']['chat']['id'];
	$mesid=$arr['message']['message_id'];
}
elseif (isset($arr['channel_post'])) {
	$tg_id = $arr['channel_post']['chat']['id'];
	$mesid=$arr['channel_post']['message_id'];
}

$rez_kb='';

// получаем пользователя.. 
$uid=$arr['message']['from']['id'];
$CLuser->getUser($uid,$arr);

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