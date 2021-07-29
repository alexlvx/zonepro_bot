<?
//exit('mysql');
/*
Класс работы с mysql
alexlvx
*/
class CLmysql{
	var $_linkdb='';
	function dbconnect($db='real'){
		$this->_linkdb = mysqli_connect(BD_HOST,BD_LOGIN,BD_PAS,BD_NAME) or die("Ошибка " . mysqli_error($this->_linkdb));	

		if (mysqli_connect_errno()) {
			printf("Соединение не удалось: %s\n", mysqli_connect_error());
			exit();
		}
		
		
		if ( ! $this->_linkdb ) {
			echo "Ошибка: Невозможно установить соединение с MySQL.";
			echo "Код ошибки errno: ".mysqli_connect_errno( );
			echo "Текст ошибки error: ".mysqli_connect_error( );
		}
	}
	function dbclose(){
		//echo $this->_linkdb;exit;
		mysqli_close($this->_linkdb); 
	}
	function insert($arr,$tab){
		$this->dbconnect();
		$link=$this->_linkdb;
		$k=$v='';
		for ($i=0;$i<count($arr);$i++){
			$key=key($arr);next($arr);
			$val=$arr[$key];
			
			$k.='`'.$key.'`';
			$v.="'".$val."'";
			
			$ds=$i+1;
			if ($ds<count($arr)){
				$k.=',';
				$v.=',';
			}
		}
		
		$sql='INSERT INTO `'.$tab.'` ('.$k.') VALUES ('.$v.')';
		//echo $sql;exit;
		mysqli_query($link,$sql);
		//INSERT INTO `user` (`id`, `name`, `TGuid`, `chat_name`) VALUES (NULL, '1', '2', '3');
	}
	function update($arr,$tab,$where){
		//UPDATE `user` SET `last_name` = 'Clip2', `username` = 'wpclip2', `role` = 'et1' WHERE `user`.`id` = 11;
		$this->dbconnect();
		$link=$this->_linkdb;
		$upd='';
		for ($i=0;$i<count($arr);$i++){
			$key=key($arr);next($arr);
			$val=$arr[$key];
			
			$upd.="`".$key."`='".$val."'";
			
			
			$ds=$i+1;
			if ($ds<count($arr)){
				$upd.=",";
			}
		}
		
		$sql='UPDATE `'.$tab.'` SET '.$upd.' WHERE '.$where;
		//echo $sql;exit;
		//echo $sql;exit;
		mysqli_query($link,$sql);
		
	}
}

$CLmysql=new CLmysql();


//$CLmysql->dbconnect();



?>