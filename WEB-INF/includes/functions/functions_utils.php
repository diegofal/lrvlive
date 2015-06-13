<?
// FUNCTII UTILE :
// --------------------------------------------------------------------------------------------------

// REPLACE_SPECIAL_CHARS:	functie de formatare a caracterelor dorite - se ataseaza caracterul \
// Parametrii: 				text - textul de modificat
// 							special_chars - sirul de caractere ptr care se va aplica functia
// Returneaza:				textul modificat
// Uz: 						la generarea sirurilor in javascript (uneori)
// --------------------------------------------------------------------------------------------------
function replace_special_chars($text, $special_chars="'\"\\") {
	$string = addcslashes($text, $special_chars);
	return $string;
}
// --------------------------------------------------------------------------------------------------


// ARRAY_MERGE_RECURSIVE2:	la fel cu array merge recursive doar ca ia in calcul si cheile numerice
// Parametrii: 				$paArray1, $paArray2 - cele 2 array-uri care se vor concatena
// Returneaza:				vector
// Uz: 						se foloseste pentru combinarea a 2 array-uri
// --------------------------------------------------------------------------------------------------
function array_merge_recursive2($paArray1, $paArray2) {
	if(!is_array($paArray1) or !is_array($paArray2)) { return $paArray2; }
	
	foreach ($paArray2 AS $sKey2 => $sValue2) {
		$paArray1[$sKey2] = array_merge_recursive2(@$paArray1[$sKey2], $sValue2);
	}
	return $paArray1;
}
// --------------------------------------------------------------------------------------------------


// ARRAY_FIRST_VALUE:	functie extragere a primei valori dintr-un vector asociativ
// Parametrii: 			$array - vectorul din care se extrage prima valoare
// 						$set - este key sau val - functie de ce se doreste extragerea
// Returneaza:			textul modificat
// Uz: 				
// --------------------------------------------------------------------------------------------------
function array_first_value($array, $set) {
	$i = 0;
	foreach($array as $key => $val) {
		if($i==0)
			$value = $$set;
		$i++;
	}
	
	return @$value;
}
// --------------------------------------------------------------------------------------------------


// ARRAY_CSORT:		functie care sorteaza un vector asociativ complex
// Parametrii: 		
// Returneaza:		vectorul ordonat
// Uz: 				in cazul vectorilor
// --------------------------------------------------------------------------------------------------
// return array_csort($this->visitors,'date',SORT_DESC,'time',SORT_DESC);
// return array_csort($this->visitors,'referrer',SORT_ASC);
// $vect = array_csort($this->visitors,'referrer',SORT_DESC);
function array_csort() {
   $args = func_get_args();
   $marray = array_shift($args);
   $msortline = "return(array_multisort(";
   $i = 0;
   foreach ($args as $arg) {
       $i++;
       if (is_string($arg)) {
           foreach ($marray as $row) {
               $sortarr[$i][] = $row[$arg];
           }
       } else {
           $sortarr[$i] = $arg;
       }
       $msortline .= "\$sortarr[".$i."],";
   }
   $msortline .= "\$marray));";
   @eval($msortline);
   return $marray;
}
// --------------------------------------------------------------------------------------------------


// GEN_PASS:	functie de generare a unei parole de maxim 32 caractere
// Parametrii: 	$nr_car - numarul de caractere care se doreste generat
// 				$text - textul ptr care se genereaza md5-ul
// Returneaza:	parola cu cate caractere se doreste
// Uz: 				
// --------------------------------------------------------------------------------------------------
function gen_pass($nr_car, $text="") {
	if($nr_car>32)
		$nr_car = 32;
	
	(empty($text)) ? $md5 = md5(uniqid(rand(), true)) : $md5 = md5($text);
	$value = substr($md5, 0, $nr_car);
	
	return $value;
}
// --------------------------------------------------------------------------------------------------
?>