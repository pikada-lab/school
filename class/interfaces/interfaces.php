<?
/// aboutClass Абстракция интерфейса с обзими функциями
/// v 0.2.3 
abstract class interfaces 
{ 
 
	protected $title; 
	protected $content;  
	protected $asaid;  
	protected $description; 
	protected $key;    
	protected $js;  
	/**
	 * Нумерованный массив файлов, которые следует вставить в конец страницы
	 * @var Array
	 */
	protected $backJs;
	
	/**
	 * Нумерованный массив файлов скриптов
	 * @var Array
	 */
	protected $script;
	/**
	 * нумерованный массив Файлов стилей
	 * @var Array
	 */
	protected $link;
	/**
	 * Нумерованный массив css файлов шрифтов
	 * @var Array
	 */
	protected $font;
	
	abstract public function __tostring(); 
	  
	/**
	 * Добавляет CSS код в заголовок
	 * @param string $file ссылка на файл css
	 */
	public function addLink($file) {
		$this->link[] = $file;
	}
	 
	/**
	 * Добавляет CSS код в заголовок с подгрузкой шрифтов
	 * @param string $file ссылка на файл css с подгрузкой шрифтов
	 */
	public function addFont($file) {
		$this->font[] = $file;
	} 
	
	/**
	 * Добавляет файл с JS кодом в заголовок
	 * @param unknown $file ссылка на файл js
	 */
	public function addScript($file) {
		$this->script[] = $file;
	}
	 
	/**
	 * Устанавливает код контента внутрь графического интерфейса
	 * @param string $html код HTML блока
	 */
	public function setContent($html=null) {
		$this->content = (string) $html;
	}
	 
	/**
	 * Устанавливает код правую колонку внутрь графического интерфейса
	 * @param string $html код HTML блока
	 */
	public function setAsaid($html=null) {
		$this->asaid = (string) $html;
	}
	 
	/**
	 * Получает код контента из графического интерфейса
	 * @return string код HTML блока
	 */
	public function getContent() {
		return $this->content;
	}
	/**
	 * Получает код правую колонку из графического интерфейса
	 * @return string код HTML блока
	 */
	public function getAsaid() {
		return $this->asaid;
	}
	 
	/**
	 * Устанавливает JS, который выполняется после загрузки страницы
	 * @param string $js код js для графического интерфейса
	 */
	public function setJS($js=null) {
		$this->js = (string) $js;
	}
	 
	/**
	 * Получает код контента из графического интерфейса
	 * @return string код js для графического интерфейса
	 */
	public function getJS() { 
		return (($this->js) ? $this->js : "console.info(\"".$this->getTitle()."\")") ;
	}
	 
	/**
	 * Метод вставляет скрипты в конец файла
	 * @return string Список скриптов в HTML
	 */
	public function getBackJS() {
		
		if( !isset($this->backJs) ) return "";
		$str = "";
		foreach($this->backJs AS $s) 
			$str .="\t\t\t<script src='".$s."'></script>\n";
		return $str;  
	}
 
	/**
	 * Добавляет файл в конец страницы
	 * @param string $file файл 
	 */
	public function addBackJs($file) {
		$this->backJs[] = $file;
	}
	/**
	 * Устанавливает данные заголовков
	 * @param unknown $title Заголовок страницы
	 * @param unknown $description описание страницы
	 * @param unknown $key ключевы слова
	 */
	public function setHead($title = null, $description, $key) { 
		if($title!=null) $this->title = $title; 
		if($description!=null) $this->description = $description; 
		if($key!=null) $this->key = $key; 
	} 
	
	/**
	 * Возвращает заголовок
	 * @return string Заголовок страницы 
	 */
	 public function getTitle() {
		 return (($this->title) ? (string) $this->title : " - ");
	 }
	  
	 
	 public function desc($title,$desc='',$key='') {
		$this->title = $title;
		$this->desc = $desc;
		$this->key = $key;
	}
	public function setImg($img) {
		$this->social_img = $img;
	}
}
?>