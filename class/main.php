<?
/// aboutClass Создаёт интерфейс и помещает в него страницу, в случае запроса мобильной версии возвращает только контент
/// v 1.2.0
class main { 

	public $content; 
	public $cl; 
	public $val; 
	public $page; 
	public $def = 'Home'; // Страница по умолчанию
	
	public $in='Web'; // Имя интерфейса, по умолчанию web 
	
	public $success; // доступ из страницы
	public $menu; // Меню из страницы 
	public static $webInt;
    private static $instance;

	
	/// конструктор проверяет входные $_GET параметры интерфейса, выставляет по умолчанию Web, создаёт имя класса страницы
	/// $cl Название страницы из .htaccsess
	 public function __construct($cl) {  
		$this->in = isset($_REQUEST['in']) ? 'interface'. $_REQUEST['in'] : 'interfaceWeb' ; 
	 
		$this->cl = isset($cl) ? 'page'.$cl : 'page'.$this->def;  
	} 
	
	/// Возвращает HTML код сайта, выполняет перенаправление в случае отсутствия прав, получает кэш сайта
	/// return HTML сайта
	public function __toString() { 
		try {	
			$this->webInterface =  new $this->in();
			self::$webInt = $this->webInterface;
			$this->page = new $this->cl($this->webInterface);  
			if(isset($_POST['ajax']) AND $_POST['ajax'] == '1' OR isset($_GET['test']) AND $_GET['test'] == '1') {
				if(!$this->success()) {
					return "<script>window.location.href = '/login';</script>";
				} 
				$str = (string) $this->page; 
			} else { // загрузка страницы 
				if(!$this->success() AND !isset($_SESSION['id'])) {
					header('location: /login');
					exit; 
				}
				$str = (string) $this->webInterface;
			} 
		} catch (Exception $e) {
			return (string) new Error(  $e->getMessage() );
		} 
		return $str;
	} 
	/// проверка прав доуступа к странице  
	private function success() {
		switch($this->page->success) {
			case '1' : return (isset($_SESSION['id']));
			default: 
				return true;
 		} 
	}
} 