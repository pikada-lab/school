<?php
/// Fake-MM
/// Dzhigurda A. Anton
function rusdate($value, $format = 1, $sclonenie=false) { 
	try {
	if(!$sclonenie) {
		$rus= array (" - ","Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");
	} else {
		$rus= array (" - ","Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
	}
	
	$d = explode(" ",$value);
	list($year,$moon,$day) = explode("-",$d[0]); 
	$mon = $rus[($moon*1)];
	
	switch($format) {
		case 1 : return $day." ".$mon." ".$year." г."; 
		case 2 : return $day." ".$mon." ";
		case 3 : return $mon;
		case 4 : return $day." ".$mon." ".$year." г. </br> ".$d[1];
		case 5 : return $day." ".$mon." ".$year." г. ".$d[1]; 
	} 
	} catch(Exception $ex) {
		return "-";
	}
}
 
 
function fake($phone, $format) {
	//$error='<p class="inf">Ошибка 12. Телефон введён неверно.</p>';
	$error='err';
	$phone=trim($phone);
	$phone=explode("(",$phone);
	$phone=implode($phone);
	$phone=explode(")",$phone);
	$phone=implode($phone);
	$phone=explode("-",$phone);
	$phone=implode($phone);
	$phone=explode(" ",$phone);
	$phone=implode($phone);
	$phone=explode(".",$phone);
	$phone=implode($phone);

	$vowels = "qwertyuiop[]assdfghjkl;'zxcvbnm/йцукенгшщзхъфывапролджэячсмитьбю!№;%:?*()_+ёЁ`Ё!QWERTYUIOP{}ASDFGHJKLZXCVBNM<>ЙЦУКЕНГШЩЗХЪФЫВАПРОЛДЖЭЯЧСМИТЬБЮ";
	$vowels = str_split($vowels);
	$regs = str_replace($vowels, "", $phone);
	$regs =trim($regs , "\x00..\x1F");
	$str=strspn($regs, "1234567890");
	$phones=str_split($regs);


	if($format==1) {
		if($str==11) { 
			return "7".$phones[1].$phones[2].$phones[3].$phones[4].$phones[5].$phones[6].$phones[7].$phones[8].$phones[9].$phones[10];
		} else if($str==10) {
			return "7".$phones[0].$phones[1].$phones[2].$phones[3].$phones[4].$phones[5].$phones[6].$phones[7].$phones[8].$phones[9];
		} else {
			return $error;
		}
	}

	if($format==2) { 
		if($str==11) { 
			return "8".$phones[1].$phones[2].$phones[3].$phones[4].$phones[5].$phones[6].$phones[7].$phones[8].$phones[9].$phones[10];
		} else if($str==10) {
			return "8".$phones[0].$phones[1].$phones[2].$phones[3].$phones[4].$phones[5].$phones[6].$phones[7].$phones[8].$phones[9];
		} else {
			return $error;
		}
	}

	if($format==3) {
		if($str==10) { 
			return "8(".$phones[0].$phones[1].$phones[2].")".$phones[3].$phones[4].$phones[5]."-".$phones[6].$phones[7]."-".$phones[8].$phones[9];
		} else if($str==11) {
			return "8(".$phones[1].$phones[2].$phones[3].")".$phones[4].$phones[5].$phones[6]."-".$phones[7].$phones[8]."-".$phones[9].$phones[10];
		} else {
			return $error;
		}
	} 
}

function imageresize($outfile,$infile,$neww,$newh,$quality=100) {
 
	switch ( strtolower(strrchr($infile, '.')) ){
	case ".jpg":
		$im= imagecreatefromjpeg($infile);
		break;
	case ".gif":
		$im= imagecreatefromgif($infile);
		break;
	case ".png":
		$im= imagecreatefrompng($infile);
		break;
	default:
		return -1;
	}
	
	list($current_width, $current_height) = getimagesize($infile);

	$prop_original = $current_width/$current_height;
	$prop_this = $neww/$newh;

	if($prop_this>$prop_original) {
		$min = $current_width;
		$max = $current_height;
		$pr=($current_width/$neww)*$newh;
		$n1=$current_width; 
		$n2=$pr; 
		$centerw=($current_width-$current_width)/2;
		$centerh=($current_height-$pr)/5;

	} else {

		$min = $current_height;
		$max = $current_width;
		$pr=($current_height/$newh)*$neww;
		$n1=$pr; 
		$n2=$current_height; 
		$centerw=($current_width-$pr)/2;
		$centerh=($current_height-$current_height)/2;
		
	}

    $im1=imagecreatetruecolor($neww,$newh);
    imagecopyresampled($im1,$im,0,0,$centerw,$centerh,$neww,$newh,$n1,$n2);

	switch ( strtolower(strrchr($outfile, '.')) ){
		case ".jpg":
			imagejpeg($im1,$outfile,$quality); // 100 - максимальное качество
			break;
		case ".gif":
			ImageGIF($im1,$outfile);
			break;
		case ".png":
			ImagePNG($im1,$outfile);
			break;
    }

    imagedestroy($im);
    imagedestroy($im1);
}
