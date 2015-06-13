<?
// clasa care realizeaza generarea de template-uri ptr diferite tipuri de fisiere :
// x3_template CLASS - START ------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
class template {

var $path_to_source_file; 	// calea fisierului template sursa
var $path_to_dest_file;		// calea fisierului template destinatie
var $file_id;				// face diferenta intre numele template-urilor


// TEMPLATE_INIT: 		initializeaza variabilele clasei template
// Parametrii: 			$folder_source - directorul sursa al fisierului template, 
// 						$folder_dest - directorul destinatie, 
// 						$file_name - numele fisierului template, 
// 						$file_ext - extensia fisierului template
// Returneaza:			calea fisierului template destinatie
// Uz: 					se foloseste inainte de orice apelare a clasei
// --------------------------------------------------------------------------------------------------
function template_init($folder_source, $folder_dest, $file_name, $file_ext) {
	$this->file_id = md5(uniqid(rand(), true));
	
	$this->path_to_source_file = $folder_source.$file_name.".".$file_ext;
	$this->path_to_dest_file = $folder_dest.$file_name."_".$this->file_id.".".$file_ext;
	
	return $this->path_to_dest_file;
}
// --------------------------------------------------------------------------------------------------


// TEMPLATE_GENERATE_HTML: 	genereaza un fisier template html
// Parametrii: 				$array_replace - sirul de inlocuire al valorilor; inlocuirea se face astfel:
// 							de tip $key => $val
// 							se inlocuiesc valorile incadrate cu {} ce corespund cheilor $key, cu valorile $val
// Returneaza:				1 TRUE, 0 FALSE
// Uz: 						la trimiterea de mail-uri de tip html
// --------------------------------------------------------------------------------------------------
function template_generate_html($array_replace) {
	$fp_dest = fopen($this->path_to_dest_file, "w");
	if($fp_dest) {
		// se deschide fisierul template ptr extragere informatii din el :
		$string_fp_source = file_get_contents($this->path_to_source_file);
		
		// se inlocuiesc variabilele dorite :
		$string_fp_dest = $string_fp_source;
		foreach($array_replace as $key => $var) {
			$string_fp_dest = str_replace("{".$key."}",$var,$string_fp_dest);
		}
		
		// se scrie continutul in noul fisier creeat :
		fwrite($fp_dest, $string_fp_dest);
	}
	
	if(fclose($fp_dest))
		return 1;
	else
		return 0;
}
// --------------------------------------------------------------------------------------------------


// TEMPLATE_GENERATE_TXT: 	genereaza un fisier txt sau de orice alt tip
// Parametrii: 				sirul de inlocuire al valorilor; inlocuirea se face astfel:
// 							$array_vars - de tip $key => $val; sunt elementele ce vor fi scrise in 
// 							fisierul text
//							$text - textul care se doreste a mai fi scris la inceputul mail-ului
// Returneaza:				1 TRUE, 0 FALSE
// Uz: 						la trimiterea de mail-uri de tip txt
// --------------------------------------------------------------------------------------------------
function template_generate_txt($array_vars, $text="") {
	$fp_dest = fopen($this->path_to_dest_file, "w");
	if($fp_dest) {
		if(!empty($text))
			$text .= "\n\n";
		
		// se inlocuiesc variabilele dorite :
		$string_fp_dest = $text;
		foreach($array_vars as $key => $var) {
			$string_fp_dest .= ucwords($key)." - ".$var."\n";
		}
		
		// se scrie continutul in noul fisier creeat :
		fwrite($fp_dest, $string_fp_dest);
	}
	
	if(fclose($fp_dest))
		return 1;
	else
		return 0;
}
// --------------------------------------------------------------------------------------------------
}
// --------------------------------------------------------------------------------------------------
// x3_template CLASS - END --------------------------------------------------------------------------
?>