<?  
/// aboutClass визуальный интерфейс - HTML декоратор 
/// v 0.2.2 
class interfaceWeb extends interfaces  { 
	public $success = 1; 
	public $len = 'ru';
	protected $script = ARRAY( 
			"./js/main.js",  
		);
	protected $backJs = Array( );
	protected $link = ARRAY(  
		 	"/css/style.css" 
		);
	protected $font = ARRAY( 
			"https://fonts.googleapis.com/icon?family=Material+Icons",
			"https://fonts.googleapis.com/css?family=Alegreya+Sans"
		);
	         
	public function __construct() { 
		//	$this->user = new user($_SESSION['id']);   
	} 
	/// Возвращает HTML код сайта, 
	/// return HTML сайта
	public function __tostring() {
	 header("Content-Type: text/html; charset=utf-8");
		$str = "<!DOCTYPE html>
			<html  lang='".$this->len."'>
			  <head>
				<title>".(($this->title) ? $this->title : "RealPub")."</title>
				<meta http-equiv='Content-Language' content='".$this->len."'> 
				<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
				<meta name='keywords' content='".$this->key."'>
				<meta name='description' content='".$this->description."'>  
				<meta name='viewport' content='width=device-width, initial-scale=0.7, user-scalable=off'>
				 
		
				<link rel='icon' href='/favicon.ico' type='image/x-icon' /> 
				<link rel='shortcut icon' href='/favicon.ico' type='image/x-icon' />\n";
				
			if($this->script) {foreach($this->script AS $s) $str .="\t\t\t<script src='".$s."'></script>\n";}
			if($this->link  ) {foreach($this->link AS $l) $str .="\t\t\t<link rel='stylesheet' type='text/css' ".(($l == '/css/print.css') ? 'media="print"' : '')." href='$l' />\n";}
			if($this->font  ) {foreach($this->font AS $l) $str .="\t\t\t<link rel='stylesheet' type='text/css'  href='$l' />\n";}
 
		$str .="    
		</head>
			<body >   
			 <div class='content'>
			 	<img src='/img/logo.png' />
					".$this->content."
			 </div>
			</body>
		</html>";
		
		return $str;
	} 
}  