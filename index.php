<?
session_start();
ini_set("display_errors", "0");

function __autoload( $className ) {
	$dir = "";
	if(preg_match("#^api_(.+)$#i",$className)) $dir = "api/";
	if(preg_match("#^page(.+|)$#i",$className)) $dir = "page/"; 
	if(preg_match("#^interface(.+)$#i",$className)) $dir = "interfaces/"; 
	if(!file_exists('./class/'.$dir.$className.'.php')) {
		// $f = new comFile($className,1,$dir);
		echo $className . " не найден в  ". __dir__ . '/class/'.$dir.$className.'.php';
		exit();
	}
	require_once( __dir__ . '/class/'.$dir.$className.'.php' );
}
 
require_once('function.php');
new connect();
echo new main($_GET['cl']); 