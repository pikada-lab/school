<?php
class form {

	private static $inc = 0;
	public static function text($text) {
		return "<p>".$text."</p>";
	}
	/**
	 * Возвращает HTML код поля ввода
	 * @param unknown $name Параметр Name
	 * @param unknown $placeholder Текст по умолчанию
	 * @param unknown $label Заголовок формы
	 * @param string $value Значение по умолчанию
	 */
	public static function input($name,$placeholder,$label,$value='',$dis = 1) {

		return "
		<div class='item'>
		<label>".$label."</label>
		<input type='text' name='".$name."' value='".$value."' placeholder='".$placeholder."' class='formInput' ".(($dis == 0) ? 'disabled' : '')."/>
		</div>
		";
	}

	/**
	 * Возвращает HTML код поля ввода
	 * @param unknown $name Параметр Name
	 * @param unknown $placeholder Текст по умолчанию
	 * @param unknown $label Заголовок формы
	 * @param string $value Значение по умолчанию
	 */
	public static function dateTime($name,$placeholder,$label,$value='') {
	
		return "
		<div class='item'>
		<label>".$label."</label>
		<input type='datetime' name='".$name."' value='".$value."' placeholder='".$placeholder."' class='formInput'/>
		</div>
		";
	}
	/**
	 * Возвращает HTML код поля ввода
	 * @param unknown $name Параметр Name
	 * @param unknown $placeholder Текст по умолчанию
	 * @param unknown $label Заголовок формы
	 * @param string $value Значение по умолчанию
	 */
	public static function dateRus($name, $label, $value='') {
		
		list($date,$time) = explode(" ",$value);
		list($y,$m,$d) = explode("-",$date);
		
		return "
		<div class='item'>
		<label>".$label."</label><div style='display: flex;'>
		<input type='number' id='day_".$name."'  min='1' max='31' value='".$d."'   class='formInput' style='flex: 0 0 160px;'  onchange='trigerDate(\"".$name."\")' onkeyup='trigerDate(\"".$name."\")'/>
		<select id='moon_".$name."' style='flex: 0 0 160px;' onchange='trigerDate(\"".$name."\")'>
			<optgroup label='Зима'>
			<option value='01' ".(($m=='01') ? "selected":"").">Январь</option>
			<option value='02' ".(($m=='02') ? "selected":"").">Февраль</option>
			</optgroup>
			<optgroup label='Весна'>
				<option value='03' ".(($m=='03') ? "selected":"").">Март</option>
				<option value='04' ".(($m=='04') ? "selected":"").">Апрель</option>
				<option value='05' ".(($m=='05') ? "selected":"").">Май</option>
			
			</optgroup>
			<optgroup label='Лето'>
				<option value='06' ".(($m=='06') ? "selected":"").">Июнь</option> 
				<option value='07' ".(($m=='07') ? "selected":"").">Июль</option>
				<option value='08' ".(($m=='08') ? "selected":"").">Август</option> 
			</optgroup>
			<optgroup label='Осень'>
				<option value='09' ".(($m=='09') ? "selected":"").">Сентябрь</option> 
				<option value='10' ".(($m=='10') ? "selected":"").">Октябрь</option>
				<option value='11' ".(($m=='11') ? "selected":"").">Ноябрь</option> 
			</optgroup>
			<optgroup label='Зима'>
				<option value='12' ".(($m=='12') ? "selected":"").">Декабрь</option>
			</optgroup>
		</select>
		<input type='number' value='".$y."' class='formInput' style='flex: 0 0 160px;' id='year_".$name."'  onchange='trigerDate(\"".$name."\")' onkeyup='trigerDate(\"".$name."\")' />
		</div>
		<input type='hidden' name='".$name."' value='".$value."' class='formInput'/>
		</div>
		<script>
 
		</script>
		";
	}
	/**
	 * Возвращает HTML код поля ввода
	 * @param string $name Параметр Name
	 * @param string $placeholder Текст по умолчанию
	 * @param string $label Заголовок формы
	 * @param string $value Значение по умолчанию
	 */
	public static function color($name,$placeholder,$label,$value='') {
	
		return "
		<div class='item'>
		<label>".$label."</label>
		<input type='color' name='".$name."' value='".$value."' placeholder='".$placeholder."' class='formInput'/>
		</div>
		";
	}
	/**
	 * Возвращает HTML код поля ввода
	 * @param unknown $name Параметр Name
	 * @param unknown $placeholder Текст по умолчанию
	 * @param unknown $label Заголовок формы
	 * @param string $value Значение по умолчанию
	 */
	public static function textarea($name,$label,$value='',$editor=1,$style='') {
	
		return "
		<div class='item'>
		<label>".$label."</label>
		<textarea type='text' name='".$name."' ".(($editor == 1) ? "alt=editor style='height: 300px;'" : "")." class='formInput' style='$style'>".$value."</textarea>
		</div>
		";
	}
	
	/**
	 * Форма загрузки файлов
	 * @param unknown $name системное название
	 * @param unknown $label описание формы 
	 * @param string $value адрес изображения, если такое есть
	 * @return string html код формы
	 */
	public static function file($name,$label,$value='',$id) {
		
			$type = strtolower ( strrchr ( $value, '.' ) ); 
		return "
		<div class='item'>
			<label>".$label."</label>
			<input type='file' name='".$name."' class='formInput' />
				".(($type == '.jpg' OR $type == '.gif' OR $type=='.png') ? "<div class='img' id='$id'>".(($value) ? "<img src='".$value."' alt='Изображение' class='theImg' />" : "")."</div>" : "")."
				".(($type == '.pdf' ) ? "<div class='img' id='$id'>".(($value) ? "<iframe src='".$value."' style='width: 100%;' class='theImg' ></iframe>" : "")."</div>" : "")."
		</div>
		";
	}
	/**
	 * Возвращает код элемента выбора
	 * @param unknown $name Параметр Name
	 * @param unknown $label Заголовок поля
	 * @param unknown $collection Двумерный масив типа array(array("id"=>1,"name"=>"Название"));
	 * @param number $index Выделяет элемент по умолчанию
	 * @return string HTML
	 */
	public static function select($name,$label,$collection,$index=0) {

		$str =  "
		<div class='item'>
			<label>".$label."</label>
			<select  name='".$name."'  class='formInput'>"; 
			foreach($collection AS $items) { 
				$str .= self::option($items[name],$items[id],($items[id] == $index));
			} 
		$str .= "
			</select> 
		</div>
		";
		return $str;
	}
	private static function option($name,$value,$selected=false) {
		return "
			<option value='".$value."' ".(($selected) ? "selected" : "").">".$name."</option>\n";
	}
	
	/**
	 * Возвращает параметр, который следует передавать вместе с формой скрыто
	 * @param string $name
	 * @param string $value
	 * @return string
	 */
	public static function checkbox($name,$value='',$label) {
		return "
		<div class='item'>
			<input type='checkbox' name='".$name."' value='1' ".(($value == 1) ? "checked ":" ")." style='float: left;'/>
			<label  style='padding: 2px 0 2px 28px'>".$label."</label>
		</div>";
	}
	
	/**
	 * Возвращает параметр, который следует передавать вместе с формой скрыто
	 * @param string $name
	 * @param string $value
	 * @return string
	 */
	public static function hidden($name,$value='') { 
		return " 
			<input type='hidden' name='".$name."' value='".$value."' />";
	}
	
	/**
	 * Декорирует конент в форму
	 * @param unknown $html HTML код контента формы
	 * @param string $id id элемента формы
	 * @return string HTML
	 */
	public static function decorForm($html,$id="form") {
		return "<div class='form'><form id='$id'>".$html."</form></div>";
	}

	/**
	 * Декорирует конент в форму с изображением человека (аватаркой)
	 * @param unknown $html HTML код контента формы
	 * @param string $id id элемента формы
	 * @return string HTML
	 */
	public static function decorFormImg($html,$id="form",$img) {
		return "<div class='form'><div class='formFlex'><img src='$img' alt='img' /><form id='$id'>".$html."</form></div></div>";
	}
	
	public static function gorizontBlock($html) {
		return "<div class='gorizontBlock'>".$html."</div>";
	}
	public static function verticalBlock($class,$html) {
		return "<div class='verticalBlock $class'>".$html."</div>";
	}
	/**
	 * Добавляет кнопку с событием js
	 * @param string $name
	 * @param string $jsEventOnClick
	 * @return string html код формы
	 */
	public static function button($name, $jsEventOnClick,$dis=1) {
		return "
				<div class='item'> 
					<input type='button'   value='$name' onclick='$jsEventOnClick' ".(($dis == "0") ? "disabled" : "" )." />
				</div>
				";
	}
	/**
	 * Добавляет блок справа
	 * @param string $name
	 * @param string $jsEventOnClick
	 * @return string html код формы
	 */
	public static function floatRight($str, $class) {
		return "
				<div class='floatRight  $class' style='float: right;     align-self: flex-end;'> 
					 $str
				</div>
				";
	}
	/**
	 * Частный случай для API вызова файлов и методов
	 * @param unknown $space Название постфикса api файла
	 * @param unknown $fn Название метода этого файла
	 */
	public static function api($space, $fn) {
		return self::hidden("space",$space).self::hidden("fn",$fn); 
	}
	 
	/**
	 * Возвращает всплывающее окно
	 * @param string $title Заголовок окна
	 * @param int $width ширина окна
	 * @param int $height высота окна
	 */
	public static function box($content, $title="Окно",$width=400,$height=300) {
		self::$inc++;
		$idForm = self::$inc;
		return "
				<div id='formBackground".$idForm."' class='background-form' onclick='api.closeForm(".$idForm.")'></div>
				<div class='box-form' id='formBox".$idForm."' style='width: ".$width."px; min-height: ".$height."px; left: calc(50% - ".($width/2)."px); top: calc(50% - ".($height/2)."px);'>
					<div class='title-form'>
						<div class='title-view'>".$title."</div>
						<div class='title-close' onclick='api.closeForm(".$idForm.")'>
							<div class='icon-cancel-circle'></div>		
						</div>
					</div>
					<div class='content-form'>
						".$content."
					</div>
				</div>";	
		
	}  
	public static function tabs(...$tab) {
		self::$inc++;
		 foreach ($tab as $i=>$t) { 
			 $title = preg_match("#<h(\d){1}>(.+)</h(\d){1}#i",$t,$res);
			$str .= "<div id='fragment-".self::$inc ."-$i'>".$t."</div>";
			$titleStr .= "<li><a href='#fragment-".self::$inc ."-$i'>".(($res[2]) ? $res[2] : "Вкладка $i")."</a></li>";
		}
		return "<div id='tabs-".self::$inc ."'>
					<ul>$titleStr</ul>
					".$str."
				</div><script> 
				  $( function() {
					$( '#tabs-".self::$inc ."' ).tabs();
				  } );
				 </script>";
	}
}