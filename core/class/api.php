<?php
class TG {
    public $token = '1781232884:AAEdjLso8u9maYpfRN1dR8CJPfI6QkXihao';
  
    
      
    public function send($id, $message, $kb,$mesid) {
        $data = array(
            'chat_id' => $id,
            'text'  => $message,
            'parse_mode' => 'HTML',
            'disable_web_page_preview'=>true,
			'reply_to_message_id' => $mesid,
           // 'reply_markup' => 
        );
		if ($kb!=''){
			$data['reply_markup']=json_encode(array('inline_keyboard' => $kb));
		}
		//echo "<pre>";print_r($data);exit;
        $this->request('sendMessage', $data);
    }  

    public function editMessageText($id, $m_id, $m_text, $kb=''){
        $data=array(
             'chat_id' => $id,
             'message_id' => $m_id,
             'parse_mode' => 'HTML',
             'text' => $m_text
        );
        if($kb)
            $data['reply_markup']=json_encode(array('inline_keyboard' => $kb));

        $this->request('editMessageText', $data); 
    }


    public function editMessageReplyMarkup($id, $m_id, $kb){
        $data=array(
             'chat_id' => $id,
             'message_id' => $m_id,
            'reply_markup' => json_encode(array('inline_keyboard' => $kb))
        );
        $this->request('editMessageReplyMarkup', $data); 
    }
    
    public function answerCallbackQuery($cb_id, $message) {
        $data = array(
            'callback_query_id'      => $cb_id,
            'text'     => $message
        );
        $this->request('answerCallbackQuery', $data);
    } 

    public function sendChatAction($id,$action='typing') {
        $data = array(
            'chat_id' => $id,
            'action'     => $action
        );
        $this->request('sendChatAction', $data);
    }


    public  function request($method, $data = array()) {
        global $CLsys;
		$d=json_encode($data);
		//$CLsys->save_log($method.": ".$d,'post');
		
		
		//echo $data;exit;
		
		
		//$url='https://api.telegram.org/bot' . $this->token .  '/' . $method."?".http_build_query($data);
		//echo file_get_contents($url);
		//echo $url;
		
		//exit;
		
		//echo "<pre>";print_r($data);
		//return;
		
		$curl = curl_init();
          
        curl_setopt($curl, CURLOPT_URL, 'https://api.telegram.org/bot' . $this->token .  '/' . $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); 
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          
        $out = json_decode(curl_exec($curl), true);
          
        //curl_exec($curl);
		
		/*if (curl_errno($curl)) {
			$error_msg = curl_error($curl);
		}
		curl_close($curl);

		if (isset($error_msg)) {
			echo "<pre>";print_r($error_msg);exit;
			// TODO - Handle cURL error accordingly
		}
		*/
		
		
		curl_close($curl);
        return $out;
    }
}




/*
@ZonePro_mi_bot: 1723368740:AAEdlcxX6QcidCnEa-Q6FO96b6T8L28MlJA Менеджер по исполнителям
@ZonePro_bot: 	 1781232884:AAEdjLso8u9maYpfRN1dR8CJPfI6QkXihao Исполнители

https://api.telegram.org/bot1723368740:AAEdlcxX6QcidCnEa-Q6FO96b6T8L28MlJA/setWebhook?url=https://tg.ga14.ru/bot_isp.php
*/

$tg = new TG();
?>