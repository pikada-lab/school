<? 
/**
 * Прототип страницы
 * @author Джигурда Антон
 * @version	0.1.0
 */
abstract class pages {
	public $success = 1;  
	
	public $title = 'Шаблон страницы'; 
	public $description = 'Шаблон дескриптора'; 
	public $key = 'Шаблон ключивых слов';  
	
	public $content = ""; 
	public $webInterface;
	 
	/**
	 * Запасной конструктор, для кода реализации
	 * @param interfaces $webInterface Графический интерфейс
	 */
	public function __construct(interfaces $webInterface) {
		$this->webInterface = $webInterface; 
		$this->generatePage();
		$this->create();
	}
	 
	/**
	 * Задаёт методанные и контент веб интерфейсу
	 */
	public function create() { 
		// $this->webInterface->setHead($this->title,$this->description, $this->key);
		$this->webInterface->setContent($this->content);
	}
 
	/**
	 * Событие, которое срабатывает при генерации страницы
	 */
	abstract public function generatePage();
	 
	/**
	 * Вывод контента для Ajax обновления страницы
	 */
	
	public function __toString() {
		return $this->content;
	}
	
	public function desc($title,$desc,$key) {
		$this->webInterface->desc($title,$desc,$key);
	}
	public function setAsaid($html) {
		$this->webInterface->setAsaid($html);
	}
}