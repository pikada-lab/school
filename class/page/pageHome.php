<?  
class pageHome extends pages {
	public $success = 0;
	public function generatePage() {
		$this->desc(
			"PIKADA-LAB CORE", 
			"Добро пожаловать",
			"");
		$this->content = "				
			<h1>PIKADA-LAB CORE</h1>	 
			<p>Добро пожаловать в минимальный набор функционального ядра для ООП PHP</p>
			<p><i class='material-icons'>work</i>
			</p><h2>Добро пожаловать на стартовую страницу</h2>
			<p>Отредактировать её можно тут: ./class/page/pageHome.php</p>";
	} 
} 