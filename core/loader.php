<?
/*
Механизм подгрузки всех классов ядра
*/
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

if (!session_id()) session_start();

define('BPATH', $_SERVER['DOCUMENT_ROOT']."/");
define('SITEPATH', "/");
define('SITEASSET', "/asset/");


//unset($_SESSION['task']);
//echo "<pre>";print_r($_SESSION['task']);exit;

include_once BPATH."core/config.php";
// подключаем все классы
include_once BPATH."core/class/api.php";
include_once BPATH."core/class/mysql.php";
include_once BPATH."core/class/user.php";
include_once BPATH."core/class/system.php";
include_once BPATH."core/class/work_menisp.php";
//

/*

include_once BPATH."core/class/templ.php";

include_once BPATH."core/class/event.php";
include_once BPATH."core/class/task.php";
include_once BPATH."core/class/calendar.php";
include_once BPATH."core/class/group.php";
include_once BPATH."core/class/goal.php";
include_once BPATH."core/class/people.php";
// подключаем бд
*/


if (isset($_GET['control'])){
	echo "<pre>";print_r($_SESSION);exit;
}
if (isset($_GET['avttoaid'])){
	// 787afc5513 - иван
	$_SESSION['aid']='787afc5513';
	$CLuser->setcook('787afc5513');
	$CLuser->checkavt();
	//echo "<pre>";print_r($_SESSION);exit;
	//exit();
}



//$CLmysql->dbclose();
?>