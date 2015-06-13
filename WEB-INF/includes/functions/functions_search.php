<?
// TEXT_LEFT_RIGHT:			functie de cautare a unui substring intr-un text, cu generarea rezultatelor
// Parametrii: 				$text - textul in care se cauta 
// 							$word - cuvantul de cautare
// 							$word_left - nr de cuvine la stanga cuvantului gasit in text, care se vor afisa
//							$word_right - nr de cuvine la dreapta cuvantului gasit in text, care se vor afisa
// Returneaza:				un vector cu textul si numarul de potriviri ale cautarii
// Uz: 						uneori
// --------------------------------------------------------------------------------------------------
function text_left_right($text, $word, $word_left, $word_right) {
	$text_strip_array = explode(" ",trim(str_replace("&nbsp;"," ",strip_tags($text))));
	
	$text_strip = trim(strtoupper(str_replace("&nbsp;"," ",strip_tags($text))));
	$text_array = explode(" ",$text_strip);
	$cuvant_cautat = strtoupper($word);
	
	// gasire pozitie cuvant in text :
	for($i=0;$i<count($text_array);$i++) {
		if(strstr($text_array[$i],$cuvant_cautat)) {
			$word_position = $i;
			break;
		}
	}
	
	// se reface sirul de afisare :
	for($i=$word_position-$word_left;$i<=$word_position+$word_right;$i++) {
		if($i==$word_position) {
			$text_return .= "<strong>".$text_strip_array[$i]."</strong> ";
		} else {
			$text_return .= $text_strip_array[$i]." ";
		}
	}
	
	$tmp['text'] = $text_return;
	$tmp['nr'] = substr_count($text_strip, $cuvant_cautat);

	return $tmp;
}
// --------------------------------------------------------------------------------------------------


// SEARCH_REPLACE:			functie de ingrosare a unui cuvant intr-un text
// Parametrii: 				$text - textul in care se cauta 
// 							$word - cuvantul de cautare
// Returneaza:				textul modificat
// Uz: 						uneori
// --------------------------------------------------------------------------------------------------
function search_replace($text, $word) {
	$array_text = explode(" ",$text);
	
	$text_string = "";
	for($i=0;$i<count($array_text);$i++) {
		if(@stristr($array_text[$i], $word)) {
			$text_string .= '<strong>'.$array_text[$i].'</strong> ';
		} else {
			$text_string .= $array_text[$i]." ";
		}
	}
	
	return trim($text_string);
}
// --------------------------------------------------------------------------------------------------
?>