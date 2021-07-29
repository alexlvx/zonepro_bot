<?
//unset($_SESSION['userinfo']);
/*
Класс работы с пользователями
alexlvx
*/
class user{ 
	var $_aid='';
	var $_userInfo=array();
	function getUser($uid,$arr){
		global $CLmysql;
		$CLmysql->dbconnect('real');
		$link=$CLmysql->_linkdb;
		
		//echo $uid;exit;
		
		$datecr=date('U')+600;
		$sql="SELECT * FROM user WHERE `TGuid`='".$uid."'";
		//echo $sql;exit;
		$r = mysqli_query($link,$sql);
		$f = mysqli_fetch_array($r);
		//echo "<pre>";print_r($f);exit;
		if (!isset($f['id'])){
			$mas=array(
				'TGuid' 		=> $uid,
				'first_name'	=> $arr['first_name'],
				'last_name'		=> $arr['last_name'],
				'username'		=> $arr['username'],
				'is_bot'		=> $arr['is_bot'],
			);
			$CLmysql->insert($mas,'user');
			$this->_userInfo=$arr;
			$this->_userInfo['role']='';
			return $arr;
		}
		$this->_userInfo=$f;
		$this->_userInfo['type']='old';
		return $f;
	}
	function setroletouser($role){
		global $CLmysql;
		$CLmysql->dbconnect('real');
		$link=$CLmysql->_linkdb;
		
		$uid=$this->_userInfo['id'];
		
		$arr=array('role'=>$role);
		$CLmysql->update($arr,'user',"`id`='".$uid."'");
		
	}
	
	function setrole($arr){
		global $tg;
		$tg_id = $arr['chat_id'];
		$mesid=$arr['message_id'];
		$uid=$arr['from_uid'];
		
		$rez_kb='';
		// приветственное сообщение для нового пользователя
		if ($arr['set_button']==''){
			$mes='Привет! Нам необходимо понять, какую роль вы будете занимать, выберете подходящую, для детального описания и начала сотрудничества';
			$x1 = array("text"=>"Менеджер","callback_data"=>"menisp");
			$x2 = array("text"=>"Специалист","callback_data"=>"isp");
			
			$rez_kb = [[$x1,$x2]];
			if (isset($mesedit)) $tg->editMessageText($tg_id,$mesid, $mes, $rez_kb);
			else $tg->send($tg_id, $mes, $rez_kb,$mesid);
			exit('ok');
		}
		elseif ($arr['set_button']!=''){
			// первый шаг, менеджер или специалист
			// если менеджер
			if ($arr['set_button']=='menisp'){
				// выдаем новые кнопки, редактируя прошлое сообщение
				$text='Менеджеры отвечают за все самое интересное, за весь процесс) Укажите, чем именно будете заниматься';
				$x1 = array("text"=>"Работа с исполнителями","callback_data"=>"s2_menisp");
				$x2 = array("text"=>"Работа с клиентами","callback_data"	=>"s2_menklient");
				$x3 = array("text"=>"Проект менеджер","callback_data"		=>"s2_pm");
				$x4 = array("text"=>"Назад","callback_data"=>"back_s1");
				$rez_kb = [[$x1],[$x2],[$x3],[$x4]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// если менеджер
			elseif ($arr['set_button']=='isp'){
				$text='Вы специалист? знаете языки программирования или отлично владеете версткой, а может ваш талант в дизайне или написании статей? присоединяйтесь! У нас Вы всегда найдете интересные задачи по Вашему профилю!';
				$x1 = array("text"=>"Присоединиться!","callback_data"=>"s2_gokanal",'url'=>'https://t.me/freelance_zonepro');
				$x2 = array("text"=>"Назад","callback_data"=>"back_s1");
				$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// ВТОРОЙ ШАГ
			// работа с исполнителями
			elseif ($arr['set_button']=='s2_menisp'){
				$text='Менеджер по работе с исполнителями, отвечает за привлечение новых специалистов. Я помогу разобраться в деталях, давая пошаговую инструкицю! Не требуются какие то спец навыки!';
				$x1 = array("text"=>"Начать работать!","callback_data"=>"s3_menisp");
				$x2 = array("text"=>"Назад","callback_data"=>"back_s2_menisp");
				$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// работа с клиентами
			elseif ($arr['set_button']=='s2_menklient'){
				$text='Менеджер по работе с клиентами, предлагает потенциальным клиентам сотрудничество с нами. Не продажи! Я помогу разобраться в деталях, давая пошаговую инструкицю! Не требуются какие то спец навыки!';
				$x1 = array("text"=>"Начать работать!","callback_data"=>"s3_menklient");
				$x2 = array("text"=>"Назад","callback_data"=>"back_s2_menisp");
				$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// Проект менеджер
			elseif ($arr['set_button']=='s2_pm'){
				$text='Проект менеджер. В нашей компании, большинство процессов автоматизированы, поэтому начать сотрудничество с нами в качество ПМ-а не составит труда даже начинающим менеджерам. Процесс максимально упрощен, не требуется поиск исполнителей, выяснение статусов работы. Вся необходимая информация всегда под рукой. Я помогу разобраться в деталях, давая пошаговую инструкицю! Жалетелен технический навык, либо навык продаж.';
				$x1 = array("text"=>"Начать работать!","callback_data"=>"s3_pm");
				$x2 = array("text"=>"Назад","callback_data"=>"back_s2_menisp");
				$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// ТРЕТИЙ ШАГ
			// менеджер по клиентам
			elseif ($arr['set_button']=='s3_menklient'){
				// устанавливаем роль
				$this->setroletouser('menklient');
				
				$text='Готово';
				//$x1 = array("text"=>"НИЧЕГО","callback_data"=>"s3_pm");
				//$x2 = array("text"=>"НИКУДА","callback_data"=>"back_s1");
				//$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// менеджер по исполнителям
			elseif ($arr['set_button']=='s3_menisp'){
				// устанавливаем роль
				$this->setroletouser('menisp');
				return true;
				//$text='Отлично! Как будете готовы начать, введите команду /работа';
				//$x1 = array("text"=>"НИЧЕГО","callback_data"=>"s3_pm");
				//$x2 = array("text"=>"НИКУДА","callback_data"=>"back_s1");
				//$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
			// проект менеджер
			elseif ($arr['set_button']=='s3_pm'){
				// устанавливаем роль
				$this->setroletouser('pm');
				
				$text='Готово';
				//$x1 = array("text"=>"НИЧЕГО","callback_data"=>"s3_pm");
				//$x2 = array("text"=>"НИКУДА","callback_data"=>"back_s1");
				//$rez_kb = [[$x1],[$x2]];
				$tg->editMessageText($tg_id,$mesid, $text, $rez_kb);
				exit('ok');
			}
		}
	}
	
	
	
}

$CLuser=new user();




?>