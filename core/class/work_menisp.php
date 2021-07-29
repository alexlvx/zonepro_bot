<?
//unset($_SESSION['userinfo']);
/*
Класс работы с пользователями
alexlvx
*/
class CLwmenisp{ 
	function work($arr){
		global $tg;
		$tg_id = $arr['chat_id'];
		$mesid=$arr['message_id'];
		$uid=$arr['from_uid'];
		$rez_kb = '';
		// Главный экран. 
		if ($arr['set_button']=='' or $arr['set_button']=='s3_menisp'){
			$mes="Это главный экран менеджера по исполнителям. Тут вы можете узнать свой баланс, статистику и другое. \n<b>Важно! Каждый раз когда Вы начинаете свой рабочий день, нажимайте кнопку \"Начать работать\", заканчивая \"Завершить день\" </b>";
			$x1 = array("text"=>"Начать работать","callback_data"=>"go");
			$x2 = array("text"=>"Прекратить быть менеджером","callback_data"=>"exit");
			$x3 = array("text"=>"Статистика","callback_data"=>"exit");
			$x4 = array("text"=>"Баланс","callback_data"=>"exit");
			$rez_kb = [[$x1,$x2],[$x3,$x4]];
			
			$tg->send($tg_id, $mes, $rez_kb,$mesid);
			//$tg->editMessageText($tg_id,$mesid, $mes, $rez_kb);
			exit('ok1');
		}
		// нажали начать работать..
		if ($arr['set_button']=='go'){
			// тут проверка, были ли ранее отклики... если были сделаем позже....
			/*
			$mes="";
			$x1 = array("text"=>"Начать работать","callback_data"=>"go");
			$x2 = array("text"=>"Прекратить быть менеджером","callback_data"=>"exit");
			$x3 = array("text"=>"Статистика","callback_data"=>"exit");
			$x4 = array("text"=>"Баланс","callback_data"=>"exit");
			$rez_kb = [[$x1,$x2],[$x3,$x4]];
			
			//$tg->send($tg_id, $mes, $rez_kb,$mesid);
			$tg->editMessageText($tg_id,$mesid, $mes, $rez_kb);
			exit('ok');
			*/
			// если откликов ранее не было...
			$mes="Для привлечения исполнителей, нужно создать задачу на нескольких подходящих ресурсах.\nДля этого перейдите на подходящую площадку, авторизируйтесь(зарегистрируйтесь в качестве работодателя), и опубликуйте задачу(примеры задач доступны по соответствующей кнопке). После публикации пришлите в чат ссылку на опубликованный проект.";
			$x1 = array("text"=>"Помощь","callback_data"=>"help");
			$x2 = array("text"=>"Примеры задач","callback_data"=>"exit");
			$x3 = array("text"=>"Мои активные проекты","callback_data"=>"exit");
			$x4 = array("text"=>"Поступил отклик","callback_data"=>"exit");
			$rez_kb = [[$x1,$x2],[$x3,$x4]];
			
			//$tg->send($tg_id, $mes, $rez_kb,$mesid);
			$tg->editMessageText($tg_id,$mesid, $mes, $rez_kb);
			exit('ok2');
		}
		
		
		exit('2');
		
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

$CLwmenisp=new CLwmenisp();




?>