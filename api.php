<?
/// Fake-MM
/// Dzhigurda A. Anton
session_start();
ini_set("display_errors", "0");
include(__DIR__ . '/function.php');
 
function __autoload( $className ) {
	
	$dir = "";
	if(preg_match("#^api_(.+)$#i",$className)) $dir = "api/"; 
	if(preg_match("#^page(.+|)$#i",$className)) $dir = "page/";
	if(preg_match("#^interface(.+)$#i",$className)) $dir = "interfaces/"; 
	
	if(!file_exists('class/'.$dir.$className.'.php')) {
		echo "Нет класса ".$className." в ".$dir." "; exit();
	}
	require_once( 'class/'.$dir.$className.'.php' );
} 
new connect();

$className = 'api_'. $_REQUEST['space'];
$fn = $_REQUEST['fn'];

$o = new $className();
$o->$fn();