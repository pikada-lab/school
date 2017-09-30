<?
/**
*	@class:connect - осуществл¤ет управление базой данных
*	@author - Джигурда Антон
*	
*/
class connect {
	private static $server = 'YOU SERVER MYSQL';
	private static $user = 'YOU USER MYSQL';
	private static $password = 'YOU PWD';
	private static $base = 'YOU BASE';
	private static $connectdb;
    private static $instance;
	
	/**
	*	@method:__construct - вызываетс¤ автоматически при создании класса, создаёт соединение с базой данных
	*/
	public function __construct() {
		if(self::$server != "YOU SERVER MYSQL") {
			$connectdb = mysql_connect(self::$server, self::$user, self::$password) or die("Ѕазы данных временно недоступны. " );
			self::$connectdb = $connectdb; 
			self::open(self::$base);
			self::setEncoding('utf8');
		}
	}
	
	/**
	*	@method:getInstance - метод дл¤ запрета создани¤ самого себ¤
	*/
	public static function getInstance() {
		if(!(self::$instance instanceof self)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	/**
	*	@method:id - метод  для вызова функции LAST id
	*/
	public static function id() {
		
		$m = mysql_query('SELECT LAST_INSERT_ID()');
		$lid = mysql_fetch_assoc($m);
		$id = $lid['LAST_INSERT_ID()'];
		
		return $id;
	}
	
	/**
	*	@method:getInstance - ћен¤ет кодировку на указанную
	*	@int $name - типо кодировки (utf8 по умолчанию)
	*/
	public function setEncoding($name)  {
		if($name) $res = mysql_query('SET NAMES '.$name);
	} 
	/**
	*	@method:q - ћен¤ет кодировку на указанную
	*	@int $sql - одиночный запрос
	*/
	public function q($sql)  {
		if($sql) {
			$res = mysql_query($sql);
			return mysql_fetch_assoc($res);
		} else {
			return false;
		}
	} 
	
	/**
	*	@method:q - Ищет по запросу все данные и возвращает id в строке  1,3,5 
	*	@int $sql - одиночный запрос
	*/
	public function queryListId($sql,$call='id',$simbol=',')  {
		if($sql) {
			$o = connect::queryListIdArray($sql,$call);
			if($o) return implode($simbol,$o); else return false;
		} else {
			return false;
		}
	} 
	
	/**
	*	@method:q - Ищет по запросу все данные и возвращает id в массиве [1,3,5]
	*	@int $sql - одиночный запрос
	*/
	public function queryListIdArray($sql,$call='id')  {
		if($sql) {
			$res = mysql_query($sql);
			while($m = mysql_fetch_assoc($res)) $o[] = $m[$call]; 
			if(isset($o)) return  $o; else return false;
		} else {
			return false;
		}
	} 
	
	/**
	*	@method:q - ћен¤ет кодировку на указанную
	*	@int $sql -  запрос
	*/
	public function query($sql)  {
		if($sql) {
			$res = mysql_query($sql);
			while($m = mysql_fetch_assoc($res)) $o[] = $m;
			return $o;
		} else {
			return false;
		}
	} 	
	public function set($sql)  {
		if($sql) {
			return mysql_query($sql); 
		} else {
			return false;
		}
	} 
	
	/**
	*	@method:open - мен¤ет базу данных
	*	@int $base - им¤ базы данных
	*/
	public function open($base) { 
		mysql_select_db($base, self::$connectdb) or die ('Не могу выбрать базу данных');
	}
}
?>