<?
// clasa care realizeaza prelucrari asupra fisierelor excel :
// aceasta clasa face extinderea claselor de lucru cu fisierele xls
// x3_excel CLASS - START ---------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
require_once "../WEB-INF/includes/classes/other_classes/class.excel/class.xls.php";

class x3_excel extends Spreadsheet_Excel {

// XLS_GENERATE_FROM_TABLE:	genereaza un fisier excel cu datele continute intr-o tabela din baza de date
// ATENTIE:					aceasta metoda nu poate fi utilizata decat in combinatie cu clasa DB_config
// Parametrii: 				$table - tabela din baza de date din care se extrag datele ptr salvare
// 							$file_name - numele fisierului excel in care se saveaza datele
// 							$array_fields - un vector ce contine campurile din tabela care se doresc a fi extrase
// 							$array_head - vector asociativ ce contine numele coloanelor cap de tabel
// 										  si tipurile acestor coloane (number sau text)
// 							$query - query-ul asupra caruia se aplica functia (optional)
// 							$where - clauza de test (otional)
// Returneaza:				fisierul xls ptr download
// Uz: 						la generarea de rapoarte din baze de date
// --------------------------------------------------------------------------------------------------
function xls_generate_from_table($table, $file_name="", $array_fields="", $array_head="", $query="", $where="") {
	// definire variabile utile :
	global $db;
	$db = new DB_config;
	
	// daca numele fisierului nu e specificat, acesta va fi inlocuit cu numele tabelei :
	if(empty($file_name))
		$file_name = $table;
	
	// se stabilesc care campuri sa fie selectate ptr extragrere :
	if(!empty($array_fields)) {
		$selected_fields = "";
		foreach($array_fields as $key => $val) {
			$selected_fields .= "`".$val."`,";
		}
		$selected_fields = substr($selected_fields,0,strlen($selected_fields)-1);
	} else {
		$selected_fields = "*";
	}
	
	// stabilirea interogarii de extragere a datelor :
	if(!empty($query))
		$query_select = $query;
	else
		$query_select = "SELECT ".$selected_fields." FROM `".$table."`";
	if(!empty($where)) {
		$query_select .= " WHERE ".$where;
	}
	
	// initializare clasa :
	$this->ExcelGen($file_name);
	
	// se lanseaza query-ul :
	$db->query($query_select);
	
	// daca nu exista un cap de tabel, se vor lua implicit numele campurilor :
	if(empty($array_head))
		$array_head = $db->arr_fields("name", "A");
	
	// se scrie capul de tabel si se iau tipurile coloanelor fisierului XLS :
	$i = 0;
	foreach($array_head as $key => $val) {
		$this->WriteText(0, $i, $key);
		$array_col_types[$i++] = $val;
	}
	
	if(!empty($array_fields))
		$nr_fields = count($array_fields);
	else
		$nr_fields = $db->num_fields();

	// se scot randurile tabelei si se insereaza in fisierul XLS :
	$row = 1;
	if($db->num_rows()!=0) {
		while($db->next_record(3))  {
			for($col=0; $col<$nr_fields; $col++) {	
				if(!empty($array_fields))
					$col_value = $array_fields[$col];
				else
					$col_value = $col;
				
				if($array_col_types[$col]=="number")
					$this->WriteNumber($row, $col, $db->Record[$col_value]);
				else
					$this->WriteText($row, $col, $db->Record[$col_value]);
			}
			$row++;
		}
	} else {
		$this->WriteText($row, 0, "No data");
	}
	
	// se face generarea fisierului XLS ptr download :
	$this->SendFile();
}
// --------------------------------------------------------------------------------------------------


// XLS_GENERATE_TO_TABLE:	salveaza datele dintr-un fisier xls intr-o tabela din baza de date
// ATENTIE:					aceasta metoda nu poate fi utilizata decat in combinatie cu clasa DB_config
// 							metoda poate fi aplicata doar asupra anumitor fisiere XLS si anume 
//							doar asupra celor care sunt salvate din XLS si nu sunt generate 
// 							cu alte metode
// Parametrii: 				$table - tabela din baza de date in care se introduc datele
// 							$file_path - calea catre fisierul excel din care se extrag datele
// 							$fields - vector ce contine numele campurilor din tabela
// Returneaza:				fisierul xls ptr download
// Uz: 						la generarea de rapoarte din baze de date
// --------------------------------------------------------------------------------------------------
function xls_generate_to_table($table, $file_path, $fields) {
	// definire variabile utile :
	global $db;
	$db = new DB_config;
	
	$this->read($file_path); // se citeste excel-ul
	
	$num_cols = $this->sheets[0]['numCols']; // nr de coloane
	$num_rows = $this->sheets[0]['numRows']; // nr de randuri
	
	$query_fields = implode(",", $fields);
	$db->query("TRUNCATE TABLE ".$table); // se goleste tabela
	
	for($i=2; $i<=$num_rows; $i++) {
		$row_xls_data = "";
		for ($j=1; $j<=$num_cols; $j++) {
			$row_xls_data .= "'".$this->sheets[0]['cells'][$i][$j]."',";
		}
		
		$add = $db->query("INSERT INTO ".$table." (".$query_fields.") VALUES (".substr_replace($row_xls_data,"",strrpos($row_xls_data,","),1).")");
	}
	
	if($add==1)
		return 1;
	else
		return 0;
}
// --------------------------------------------------------------------------------------------------

function xls_generate_from_array($_array, $file_name, $array_fields, $array_head) {

	// initializare clasa :
	$this->ExcelGen($file_name);
	
	
	// se scrie capul de tabel si se iau tipurile coloanelor fisierului XLS :
	$i = 0;
	foreach($array_head as $key => $val) {
		$this->WriteText(0, $i, $key);
		$array_col_types[$i++] = $val;
	}


	if(!empty($array_head))
		$nr_fields = count($array_head);
		
		
	// se scot randurile tabelei si se insereaza in fisierul XLS :
	$row = 1;
	if(sizeof($_array)!=0) {
		foreach ($_array as $value) {
			for($col=0; $col<$nr_fields; $col++) {	
				if(!empty($array_fields))
					$col_value = $array_fields[$col];
				else
					$col_value = $col;
				
				if($array_col_types[$col]=="number")
					$this->WriteNumber($row, $col, $value[$col_value]);
				else
					$this->WriteText($row, $col, $value[$col_value]);
			}
			$row++;
		}
	} else {
		$this->WriteText($row, 0, "No data");
	}
	
	// se face generarea fisierului XLS ptr download :
	$this->SendFile();
}


}
// --------------------------------------------------------------------------------------------------
// x3_excel CLASS - END -----------------------------------------------------------------------------
?>