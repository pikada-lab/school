<?php
/**
 * Библеотека осуществляет управление базой данных MySQL 
 * @author Джишурда
 * @version 1.2.2
 * @tags php7 mysqli
 */

class connect { 
	private static $server = 'mysql4.locum.ru';
	private static $user = 'musicalm_trast72';
	private static $password = 'Ak4mQGpSHq';
	private static $base = 'musicalm_trast72';
	private static $connectdb;
    private static $instance;
	  
	/**
	 * вызывается автоматически при создании класса, создаЄт соединение с базой данных 
	 */
	public function __construct() {  
		$connectdb = new mysqli(self::$server, self::$user, self::$password, self::$base);
		if(mysqli_connect_errno()) { 
			echo ("<h1>Базы данных временно недоступны.</h1>" ); 
			exit(); 
		}
		self::$connectdb = $connectdb;  
		self::setEncoding(); 
	}
	  
	/**
	 * метод для запрета создания самого себя 
	 * @return connect
	 */
	public static function getInstance() {
		if(!(self::$instance instanceof self)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	 
	/**
	 * Выполняет запрос INSERT, UPDATE или DELETE
	 * @param string $sql - запрос SQL
	 */
	 public static function set($sql) {
		if ($result = self::$connectdb->query($sql)) {  
			 return true;
		} else {
			return false;
		}
	 }
	  	
	 /**
	  * метод  для вызова функции LAST id 
	  * @return mixed - Номер последней записи в БД 
	  */
	public static function id() { 
		$m = self::q('SELECT LAST_INSERT_ID() as `id`');  
		return $m['id'];
	}
	
	/**
	 * Меняет кодировку на указанную
	 * @param string $name тип кодировки (utf8 по умолчанию)
	 */
	public function setEncoding($name='utf8')  {
	 if($name) self::set('SET NAMES '.$name);
	} 
 
	/**
	 * Выполняет запрос к базе данных
	 * @param string $sql SQL запрос
	 * @return Array|boolean Ответ SQL сервера
	 */
	public static function q($sql)  {
		if($sql) {			
			if ($result = self::$connectdb->query($sql)) {
				$resp = $result->fetch_assoc();
				$result->close(); 
			}
			return $resp;
		} else {
			return false;
		}
	}  
	
	/**
	 * Ищет по запросу все данные и возвращает id в строке - пример: 1,3,5 
	 * @param string $sql SQL запрос
	 * @param string $call название колонки в БД, из которой извлекать данные
	 * @param string $simbol Разделяющий символ 
	 * @return string|boolean пример 1,2,4
	 */
	public static function queryListId($sql,$call='id',$simbol=',')  {
		if($sql) {
			$o = connect::queryListIdArray($sql,$call);
			if($o) return implode($simbol,$o); else return false;
		} else {
			return false;
		}
	} 
	   
	/**
	 * Ищет по запросу все данные и возвращает id в массиве [1,3,5]
	 * @param string $sql SQL запрос
	 * @param string $call Название колонки в БД, из которой извлекать данные
	 * @return mixed|boolean пример массива [1,3,5]
	 */
	public static function queryListIdArray($sql,$call='id')  {
		if($sql) {
			if ($result = self::$connectdb->query($sql)) { 
				while($v = $result->fetch_assoc()) $o[] = $v[$call]; 
				$result->close(); 
			}  
			if($o) return  $o; else return false;
		} else {
			return false;
		}
	} 
	 
	/**
	 * Выполняет SQL запрос с 1 и более результатом 
	 * @param string $sql - SQL запрос
	 * @return array|boolean Ответ сервера
	 */
	public static function query($sql)  {
		if($sql) {			
			 if ($result = self::$connectdb->query($sql)) { 			
				while($m = $result->fetch_assoc()) {$o[] = $m;};
				$result->close(); 
			} 
			return $o;
		}  
		return false; 
	} 
 
	/**
	 * Обходит все элементы, которые возвращает SQL запрос и выполняет передаваемый метод
	 * @param string $sql SQL запрос
	 * @param string $invok ссылка на метод (строка)
	 * @return boolean если нет SQL Выполнен возвращает true
	 */
	public static function interator($sql,$invok)  {
		$res = self::$connectdb->query($sql);
		if($res) {
			while($m = $result->fetch_assoc()) $invok($m);
			$result->close(); 
			return true;
		} else {
			return false;
		}
	}  
}