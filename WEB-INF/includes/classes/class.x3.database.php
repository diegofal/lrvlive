<?
// clasa care realizeaza interactiunea cu bazele de date
// x3_database CLASS - START ------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
class x3_database {

var $mysql_host		= ""; 		// serverul bd (de obicei localhost)
var $mysql_database	= ""; 		// baza de date
var $mysql_username	= ""; 		// user bazei de date
var $mysql_password	= ""; 		// parola

var $Link_ID  = 0;  			// resultat mysql_connect()
var $Query_ID = 0;  			// ultimul id din mysql_query().
var $Record = array();  		// vectorul mysql_fetch_array()-result.
var $Row;           			// nr liniei currente

var $Errno    = 0;  			// eroare interogarii
var $Error    = "";

var $sid = "";					// valoarea identificatorului de sesiune
var $time = "";					// timpul UNIXTIMESTAMP actual


// HALT: 			distruge sesiunea in cazul in care apar erori
// Parametrii: 		$msg - mesajul de eroare care va fi afisat
// Returneaza:		-
// Uz: 				se foloseste de preferabil din interiorul clasei
// --------------------------------------------------------------------------------------------------
function halt($msg) {
	printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
	printf("<b>MySQL Error</b>: %s (%s)<br>\n",$this->Errno,$this->Error);
	die("Session halted.");
}
// --------------------------------------------------------------------------------------------------


// CONNECT: 		realizeaza conexiunea la o baza de date
// Parametrii: 		-
// Returneaza:		- 
// Uz: 				in general functie interna
// --------------------------------------------------------------------------------------------------
function connect() {
	if($this->Link_ID == 0) {
		$this->Link_ID = mysql_connect($this->mysql_host, $this->mysql_username, $this->mysql_password);
		
		if(!$this->Link_ID) {
			$this->halt(mysql_errno().":".mysql_error());
		}
		else {
		  	$select_db = mysql_select_db($this->mysql_database, $this->Link_ID);
			if(!$select_db)
				$this->halt(mysql_errno().":".mysql_error());
		}

		//Asta este varianta veche - functioneaza numai sub unele servere 
		/*if (!mysql_query(sprintf("use %s",$this->mysql_database),$this->Link_ID)) {
		$this->halt("cannot use database ".$this->mysql_database);
		}*/
	}
}
// --------------------------------------------------------------------------------------------------


// QUERY:			lanseaza un query care baza de date selectata
// Parametrii: 		$Query_String - Interogarea propriu zisa
// Returneaza:		identificatorul resursei query-ului sau FALSE, daca query-ul este invalid
// Uz: 				se foloseste la orice interactiune cu baza de date
// --------------------------------------------------------------------------------------------------
function query($Query_String) {
	$this->connect();
	$this->Query_ID = mysql_query($Query_String,$this->Link_ID);
	$this->Row   = 0;
	$this->Errno = mysql_errno();
	$this->Error = mysql_error();
	if (!$this->Query_ID) {
		$this->halt("Invalid SQL: ".$Query_String);
	}
	return $this->Query_ID;
}
// --------------------------------------------------------------------------------------------------


// CLOSE :			realizeaza deconectarea de la o baza de date
// Parametrii: 		-
// Returneaza:		-
// Uz: 				la inchiderea conexiunii
// --------------------------------------------------------------------------------------------------
function close() {
	mysql_close($this->Link_ID);
}
// --------------------------------------------------------------------------------------------------


// NEXT_RECORD :	pozitioneaza flag-ul pe urmatoarea linie din vectorul returnat dupa o interogare
// Parametrii: 		$type - tipul datelor extrase: MYSQL_ASSOC (1), MYSQL_NUM (2), and MYSQL_BOTH (3)
// 						  - implicit MYSQL_BOTH
// Returneaza:		inregsitrarea curenta a flag-ului, sau mesajul de eroare in cazul in care nu rezultatul 
// 					dat de interogare nu e vector
// Uz: 				ptr parcurgerea rezultatelor deintr-o baza de date 
// --------------------------------------------------------------------------------------------------
function next_record($type=3) {
	$this->Record = mysql_fetch_array($this->Query_ID, $type);
	$this->Row   += 1;
	$this->Errno = mysql_errno();
	$this->Error = mysql_error();

	$stat = is_array($this->Record);
	if(!$stat) {
		mysql_free_result($this->Query_ID);
		$this->Query_ID = 0;
	}
	return $stat;
}
// --------------------------------------------------------------------------------------------------


// NUM_ROWS :		numarul de articole din vector
// Parametrii: 		-
// Returneaza:		numar
// Uz: 				cateodata
// --------------------------------------------------------------------------------------------------
function num_rows() {
	return mysql_num_rows($this->Query_ID);
}
// --------------------------------------------------------------------------------------------------


// ARR_FIELDS:		returneaza un array cu numele campurilor dintr-o tabela a unui query lansat anterior
// Parametrii: 		$field - tipul datelor care vor fi salvate in vector
// 						   - poate fi name(numele campului) sau type(tipul campului) (implicit name)
// 					$array_type - tipul vectorului care se formeaza
// 								- poate fi S(simplu) sau A(asociativ) (implicit S)
// Returneaza:		array
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function arr_fields($field="name", $array_type="S") {
	// setarea variabilelor sosite empty :
	$field = (empty($field)) ? "name" : $field;
	$array_type = (empty($array_type)) ? "S" : $array_type;
	
	$temp = array();
	
	for($i=0; $i < $this->num_fields(); $i++) {
		$field_name = mysql_field_name($this->Query_ID, $i);
		$field_type = mysql_field_type($this->Query_ID, $i);
		
		if($array_type=="S") {
			if($field=="name") {
				$temp[] = $field_name;
			} elseif($field=="type") {
				$temp[] = $field_type;
			}
		} elseif($array_type=="A") {
			$temp[$field_type] = $field_name;
		}
	}
	return $temp;
}
// --------------------------------------------------------------------------------------------------


// NUM_FIELDS:		returneaza numarul de campuri dintr-o tabela a unui query lansat anterior
// Parametrii: 		-
// Returneaza:		numar
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function num_fields() {
	return mysql_num_fields($this->Query_ID);
}
// --------------------------------------------------------------------------------------------------


// FIELDS_NAME:		afiseaza campurile dintr-o tabela a unui query lansat anterior, despartite de | 
// Parametrii: 		-
// Returneaza:		-
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function fields_name() {
	$array_fields = "|";
	
	for($i=0;$i<$this->num_fields();$i++) {
		$array_fields .= mysql_field_name($this->Query_ID,$i).'|';	
	}
	
	return $array_fields;
}
// --------------------------------------------------------------------------------------------------


// AFFECTED_ROWS:	returneaza numarul articole care au suferit in urma ultimei interogari
// Parametrii: 		-
// Returneaza:		numar
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function affected_rows() {
	return @mysql_affected_rows($this->Link_ID);
}
// --------------------------------------------------------------------------------------------------


// GET_AUTO_INCREMENT:	returneaza incrementul coloanei PRIMARY-AUTO_INCREMENT
// Parametrii: 			$table - tabela din baza de date asupra careia se aplica
// Returneaza:			autoincrementul urmator din tabelul dat
// Uz: 					des
// --------------------------------------------------------------------------------------------------
function get_auto_increment($table) {
	$row = mysql_fetch_array(mysql_query("SHOW TABLE STATUS FROM `".$this->mysql_database."` LIKE '".$table."'"));
	return $row["Auto_increment"];
}
// --------------------------------------------------------------------------------------------------


// GET_NUM_ROWS:	returneaza numarul de articole din tabel in cazul in care nu se da un alt query
// Parametrii: 		$table - tabela din baza de date
// 					$query - query-ul asupra caruia se aplica functia (optional)
// 					$where - clauza de test (otional)
// Returneaza:		numar
// Uz: 				des
// --------------------------------------------------------------------------------------------------
function get_num_rows($table, $query="", $where="") {
	if(!empty($query))
		$query_select = $query;
	else
		$query_select = "SELECT * FROM `".$table."`";
		
	if(!empty($where)) {
		$query_select .= " WHERE ".$where;
	}
	
	$this->query($query_select);
	return $this->num_rows();
}
// --------------------------------------------------------------------------------------------------


// EXIST_VALUE:		verifica daca exista o valoare in baza de date pe un anumit camp
// Parametrii: 		$table - tabelul din baza de date
// 					$field - nume camp din tabela (otional)
// 					$value - valoare cautata (otional)
// 					$where - clauza de test (otional)
// Returneaza:		numarul de articole gasite
// Uz: 				cand se vrea ca pe un camp sa existe elemente unice (email de exemplu)
// --------------------------------------------------------------------------------------------------
function exist_value($table, $field="", $value="", $where="") {
	if(!empty($where)) {
		$where_query = $where;
		$select = "*";
	} else {
		$where_query = $field."='".$value."'";
		$select = $field;
	}
	
	$this->query("SELECT ".$select." FROM `".$table."` WHERE ".$where_query);
	return $this->num_rows();
}
// --------------------------------------------------------------------------------------------------


// SELECT_FIELD:	selectie articole dupa un anumit camp din baza de date
// Parametrii: 		$table - tabelul din baza de date
// 					$field - campul de pe care se iau articolele
// 					$field_order - campul din tabela dupa care se ordoneaza vectorul format (optional)
// 					$query - query-ul asupra caruia se aplica functia (optional)
// Returneaza:		array cu articolele de pe campul selectat
// Uz: 				pentru un select simpul
// --------------------------------------------------------------------------------------------------
function select_field($table, $field, $field_order="", $query="") {
	$records = array();
	
	if(!empty($query))
		$query_select = $query;
	else
		$query_select = "SELECT ".$field." FROM `".$table."`";
	
	if(!empty($field_order))
		$query_select .= " ORDER BY ".$field_order;
	
	$this->query($query_select);
	while($this->next_record()) {
		$records[] = trim(stripslashes($this->Record[$field]));
	}
	
	return $records;
}
// --------------------------------------------------------------------------------------------------


// SELECT_FIELDS:	extrage articolele dintr-o tabela/query functie de anumiti parametrii
// Parametrii: 		$table - tabelul din baza de date
// 					$query - query-ul asupra caruia se aplica functia (optional)
// 					$fields - un array cu campurile care se selecteaza din tabela (optional)
// 					$field - campul dupa care se face o cautare (optional)
// 					$value - valoarea cautata (optional)
// 					$field_order - campul dupa care se face ordonarea (optional)
// 					$limit_start - limita de inceput a extragerii (optional)
// 					$limit_end - nr de elemente rezultate la o extragere (optional)
// 					$single - este 1, daca se extrage o unica inregistrare (optional)
// 					$form - este 1, daca datele se extrag ptr editarea intr-un formular (optional)
// Returneaza:		array
// Uz: 				foarte des
// --------------------------------------------------------------------------------------------------
function select_fields($table, $query="", $fields="", $field="", $value="", $field_order="", $limit_start="", $limit_end="", $single="", $form="") {
	// in cazul in care vectorul cu campuri este gol, se vor lua implicit toate capmurile :
	if(empty($fields) && !is_array($fields)) {
		$this->query("SELECT * FROM `".$table."`");
		$fields_txt = $this->fields_name();
		$fields = explode('|', substr($fields_txt, 1, strlen($fields_txt)-2));
	}
	
	if(!empty($query)) {
		$query_select = $query;
	} else {
		$selected_fields = "";
		if(!empty($fields) && is_array($fields)) {
			for($i=0;$i<count($fields);$i++) {
				$selected_fields .= $fields[$i].',';
			}
			$selected_fields = substr_replace($selected_fields, '', strrpos($selected_fields, ","));
		} else {
			$selected_fields = "*";
		}
		
		$query_select = "SELECT ".$selected_fields." FROM `".$table."`";
		if(!empty($field) && isset($value))
			$query_select .= " WHERE ".$field."='".$value."'";
	}
	// ordonare dupa camp :
	if(!empty($field_order)) {
		// se verifica daca campul de ordonare contine si tipul ordonarii (ASC/DESC) :
		$array_field_order = explode('|',$field_order);
		if(count($array_field_order)==2)
			$query_select .= " ORDER BY ".$array_field_order[0]." ".$array_field_order[1];
		else
			$query_select .= " ORDER BY ".$field_order;
	}
	// limitare afisari :
	if(!empty($limit_end))
		$query_select .= " LIMIT ".$limit_start.",".$limit_end;
	return $this->generate_records($query_select, $fields, $single, $form);
}
// --------------------------------------------------------------------------------------------------


// GENERATE_RECORDS:	genereaza un array cu articolele dorite, dintr-un query
// Parametrii: 			$query - query-ul asupra caruia se aplica functia
// 						$fields - un array cu campurile care se selecteaza din tabela
// 						$single - este 1, daca se extrage o unica inregistrare (optional)
// 						$form - este 1, daca datele se extrag ptr editarea intr-un formular (optional)
// Uz: 					functie interna
// --------------------------------------------------------------------------------------------------
function generate_records($query, $fields, $single="", $form="") {
	$records = array();
	
	$this->query($query);
	$nr_records = $this->num_rows($query);
	if($single==1) {
		$this->next_record();
		for($i=0;$i<count($fields);$i++) {
			if($form==1)
				$tmp[$fields[$i]] = trim(htmlspecialchars(stripslashes($this->Record[$fields[$i]])));
			else
				$tmp[$fields[$i]] = trim(stripslashes($this->Record[$fields[$i]]));
		}
		$records = $tmp;
	} else {
		if($nr_records>0) {
			while($this->next_record()) {
				for($i=0;$i<count($fields);$i++) {
					if (isset($this->Record[$fields[$i]]))
						$tmp[$fields[$i]] = trim(stripslashes($this->Record[$fields[$i]]));
				}
				
				$records[] = $tmp;
			}
		}
	}
	return $records;
}
// --------------------------------------------------------------------------------------------------


// SELECT_FIELD_KEYVAL:	functie de generare a uni array de tipul key=>val
// Parametrii: 			$table - tabela din baza de date selectata
// 						$query - query-ul asupra caruia se aplica functia (optional)
// 						$fieldkey - campul cheie
// 						$fieldval - campul valoare
// 						$field_order - campul dupa care se face ordonarea (optional)	
// Returneaza:			array
// Uz: 					pentru un array complex
// --------------------------------------------------------------------------------------------------
function select_field_keyval($table, $query="", $fieldkey, $fieldval, $field_order="") {
	$records = array();
	
	if(!empty($query))
		$query_select = $query;
	else
		$query_select = "SELECT ".$fieldkey.",".$fieldval." FROM `".$table."`";

	if(!empty($field_order))
		$query_select .= " ORDER BY ".$field_order;
		
	$this->query($query_select);
	while($this->next_record()) {
		$records[trim(stripslashes($this->Record[$fieldkey]))] = trim(stripslashes($this->Record[$fieldval]));
	}
	
	return $records;
}
// --------------------------------------------------------------------------------------------------


// DELETE_FIELD:	face stergerea unui camp sau a tuturor campurilor dintr-o tabela
// Parametrii: 		$table - tabela din baza de date
// 					$field - campul dupa care se face o cautare (optional)
// 					$value - valoarea cautata (optional)			
// 					$query - query-ul asupra caruia se aplica functia (optional)
// 					$where - este conditia care se impune interogarii (optional)
// Returneaza:		nr de randuri afectate
// Uz: 				des
// --------------------------------------------------------------------------------------------------
function delete_field($table, $field="", $value="", $query="", $where="") {
	if(!empty($query)) {
		$query_delete = $query;
	} else {
		!empty($where) ? $where_condition = $where : $where_condition = $field."='".$value."'";
		$query_delete = "DELETE FROM `".$table."` WHERE ".$where_condition;
	}
		
	$this->query($query_delete);
	return $this->affected_rows();
}
// --------------------------------------------------------------------------------------------------


// EDIT_FIELD:		editeaza un camp dintr-o tabela selectata
// Parametrii: 		$table - tabela din baza de date
// 					$array_fields - sirul ce contine numele campurilor din tabela care se editeaza
// 					$field - campul dupa care se face o cautare (optional)
// 					$value - valoarea cautata (optional)
// 					$array_data_prel - campurile care sunt prelucrate altfel decat $array_fields (optional)
// 					$array_exceptions - campurile care sa fie excluse din sirul $array_fields (optional)
// 					$where - este conditia dupa care se va efectua interogarea de editare
// Returneaza:		nr de randuri afectate
// Uz: 				des
// --------------------------------------------------------------------------------------------------

function edit_field($table, $array_fields, $field="", $value="", $array_data_prel="", $array_exceptions="", $where="") {
	$edited_fields = "";
	foreach($array_fields as $key => $val) {
		// se verifica daca exista date prelucrate :
		if(count($array_data_prel)!=0 && !empty($array_data_prel)) {
			foreach($array_data_prel as $key_prel => $val_prel) {
				if($key_prel==$key) {
					$val = $val_prel;
				}
			}
		}

		// se verifica sa nu se ia campul de upload imagini si campul but :
		if(substr($key,0,4)!="pict" && substr($key,0,3)!="but" && !@in_array($key, $array_exceptions)) {
			if ($val === 'NULL') { //IMPORTANT ===
				$edited_fields .= $key."=NULL,";	
			} else {
				$edited_fields .= $key."='".trim(addslashes($val))."',";	
			}
			
		}

	}
	$edited_fields = substr_replace($edited_fields, '', strrpos($edited_fields, ","));

	$query_edit = "UPDATE `".$table."` SET ".$edited_fields;
	if(!empty($field) && !empty($value)) {
		$query_edit .= " WHERE ".$field."='".$value."'";
		if(!empty($where))
			$query_edit .= " AND ".$where;
	} else {
		if(!empty($where))
			$query_edit .= " WHERE ".$where;
	}

	$this->query($query_edit);
	return $this->affected_rows();	
}
// --------------------------------------------------------------------------------------------------


// INSERT_FIELD:	insereaza un aticol in baza de date
// Parametrii: 		$table - tabela din baza de date
// 					$array_fields - sirul ce contine numele campurilor din tabela care se editeaza
// 					$array_data_prel - campurile care sunt prelucrate altfel decat $array_fields (optional)
// 					$array_exceptions - campurile care sa fie excluse din sirul $array_fields (optional)
// Returneaza:		nr de randuri afectate
// Uz: 				des
// --------------------------------------------------------------------------------------------------
function insert_field($table, $array_fields, $array_data_prel="", $array_exceptions="") {
	$fields = $values = "";
	
	foreach($array_fields as $key => $val) {
		// se verifica daca exista date prelucrate :
		if(count($array_data_prel)!=0 && !empty($array_data_prel)) {
			foreach($array_data_prel as $key_prel => $val_prel) {
				if($key_prel==$key) {
					$val = $val_prel;
				}
			}
		}
		// se verifica sa nu se ia campul de upload imagini si campul but :
		if(substr($key,0,4)!="pict" && substr($key,0,3)!="but" && !@in_array($key, $array_exceptions)) {
			$fields .= $key.",";
			$values .= "'".trim(addslashes($val))."',";
		}
	}
	$fields = substr_replace($fields, '', strrpos($fields, ","));
	$values = substr_replace($values, '', strrpos($values, ","));
	$query_insert = "INSERT INTO `".$table."` (".$fields.") VALUES (".$values.")";
	//echo $query_insert; exit();
	$this->query($query_insert);
	
	return $this->affected_rows();	
}
// --------------------------------------------------------------------------------------------------


// DELETE_FILE:		functie de stergere a unui fisier (fizic din director si din baza de date)
// Parametrii: 		$table - tabela din baza de date
// 					$field_id - numele campului din tabela dupa care se face cautarea
// 					$id - valoarea dupa care se cauta
// 					$field_file - numele campului din tabela ce contine fisierul
// 					$path - calea(directorul) catre fisierele care se sterg
// 					$both(folosit in cazul imaginilor) - este 1, daca exista fisiere in ambele directoare 
// 														 thumb/large (optional)
// Returneaza:		1 TRUE, 0 FALSE
// Uz: 				uneori
// --------------------------------------------------------------------------------------------------
function delete_file($table, $field_id, $id, $field_file, $path, $both="") {
	// se selecteaza fisierul din baza de date ptr a i se lua numele :
	$this->query("SELECT ".$field_file." FROM `".$table."` WHERE ".$field_id."='".$id."'");
	if($this->num_rows()>0) {
		$this->next_record();
		
		// se verifica daca se face stergerea la ambele imagini (thumb,large) :
		if($both==1) {
			// se sterg fisierele, daca ele exista :
			if(file_exists($path."large/large_".$this->Record[$field_file]) && !empty($this->Record[$field_file]))
				unlink($path."large/large_".$this->Record[$field_file]);
			if(file_exists($path."thumb/thumb_".$this->Record[$field_file]) && !empty($this->Record[$field_file]))
				unlink($path."thumb/thumb_".$this->Record[$field_file]);
		} else {
			// se sterge fisierul fizic din director, daca exista :
			if(file_exists($path.$this->Record[$field_file]) && !empty($this->Record[$field_file]))
				unlink($path.$this->Record[$field_file]);
		}
		
		// se sterge fisierul din tabela :
		$db_query = $this->query("UPDATE `".$table."` SET ".$field_file."='' WHERE ".$field_id."='".$id."'");
	}
	
	return $db_query;
}
// --------------------------------------------------------------------------------------------------


// GEN_RANDOM:		generarea de elemente random(diferite) dintr-o tabela
// Parametrii: 		$query - query-ul care se acceseaza
// 					$field - numele campului cu elementele care se vor genera random
// 					$nr_randoms - nr de elemente random care se vor genera
// Returneaza:		sirul cu elementele random corespunzatoare campului selectat
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function gen_random($query, $field, $nr_randoms) {
	$this->query($query);
	
	// se scot toate inregistrarile functie de query-ul trimis :
	while($this->next_record()) {
		$sir_featured[] = $this->Record[$field];
	}
	
	// se genereaza sirul random :
	if(count($sir_featured)!=0) {
		if($nr_randoms>count($sir_featured))
			$nr_rand = count($sir_featured);
		else
			$nr_rand = $nr_randoms;
		$rand_keys = array_rand($sir_featured, $nr_rand);
	}
	
	// se construieste sirul cu elementele random :
	if(count($rand_keys)==1) {
		$sir_randoms[0] = $sir_featured[0];
	} else {
		for($i=0;$i<count($rand_keys);$i++) {
			$sir_randoms[$i] = $sir_featured[$rand_keys[$i]];
		}
	}
	
	return $sir_randoms;
}
// --------------------------------------------------------------------------------------------------


// INSERT_FILE:		functie de adugare si copiere a fisierelor in baza de date si in director fizic
// Parametrii: 		$table - tabela in care se insereaza noul fisier
//					$field_id - camp dupa care se cauta
//					$id - valoare camp cautare
//					$field_pict - numele campului in care se introduce numele fisierului
//					$_files - sirul de fisiere care se vor adauga (de obicei de tip $_FILES)
//					$path - calea directorului unde se salveaza fisierele
//					$large_dim - dim img mare (in cazul imaginilor) (optional)
//					$thumb_dim - dim img mica (in cazul imaginilor) (optional)
//					$both - este 1, daca se introduc ambele imagini(large si thumb) (optional)
//					$file_type - este 1, daca fisierul e de alt tip decat imagine (optional)
// 					$name - este numele fisierului din sirul $_files (implicit = pict)
// 					$method - poate fi "move" sau "copy". Daca se alege "move", fisierele vor fi
// 							  copiate cu ajutorul functiei "move_uploaded_file". Daca se alege "copy",
//							  functia de copiere utilizata va fi "copy". (implicit = "move")
// Returneaza:		return 1 - fisierul a fost inserat cu succes
//					return 2 - daca fisierul nu exista
//					return 0 - eroare de inserare
// Uz: 				uneori
// --------------------------------------------------------------------------------------------------
function insert_file($table, $field_id, $id, $field_pict, $_files, $path, $large_dim="", $thumb_dim="", $both="", $file_type="", $name="pict", $method="move") {
	require_once "class.x3.image.php";
	$image = new x3_image;
		
	// se verifica daca imaginea se introduce si mica si mare :
	if($both==1) {
		$large_name = "";
		$thumb_name = "";
		$large_dir = "large/";
		$thumb_dir = "thumb/";
	} else {
		$large_name = "";
		$thumb_name = "";
		$large_dir = "";
		$thumb_dir = "";
	}
	
	// se verifica introducerea imaginii/fisierului :
	if($_files[$name]['tmp_name']!="" && filesize($_files[$name]['tmp_name'])>0) {
		// se ia extensia imaginii/fisierului :
		//echo $_files[$name]['name']." -------------- ".substr($_files[$name]['name'],strrpos($_files[$name]['name'],".")+1);
		$name_file = strtolower($id.'_'.$name."_".time().'.'.substr($_files[$name]['name'],strrpos($_files[$name]['name'],".")+1));
		$dest_file = $path.$large_dir.$large_name.$name_file;
		
		// in cazul in care nu sunt specificate dimensiunile imaginii, se vor lua dimensiunile reale :
		if(empty($large_dim)) {
			$img_size = getimagesize($_files[$name]['tmp_name']);
			$large_dim = ($img_size[0]>$img_size[1]) ? $img_size[0] : $img_size[1] ;
		}
		
		// se copiaza imaginiea large, daca e imagine :		
		if($file_type!=1) {						
			$image->load_image($_files[$name]['tmp_name']);			
			$image->resizeWH($large_dim,$large_dim);			
			$image->save_image($dest_file, 100);			
		
			if(file_exists($dest_file) && $both==1) {				
				@chmod($dest_file, 0777);				
				
				$image->load_image($dest_file);				
				$image->resizeWH($thumb_dim,$thumb_dim);				
				$image->save_image($path.$thumb_dir.$thumb_name.$name_file, 100);
				
			}
		} else {
			if(empty($_FILES)) {
				copy($_files[$name]['tmp_name'], $dest_file);
			} else {
				if($method=="copy")
					copy($_files[$name]['tmp_name'], $dest_file);
				else
					move_uploaded_file($_files[$name]['tmp_name'], $dest_file);
			}
		}
		
		// se introduce si in baza de date :
		$query_update = "UPDATE `".$table."` SET ".$field_pict."='".$name_file."'  WHERE ".$field_id."='".$id."'";
		$db_query = $this->query($query_update);
	} else {
		$db_query = 2;
	}
	
	return $db_query;
}
// --------------------------------------------------------------------------------------------------


// VERIFY_PAGE_LOCATION: 	functie utila pentru verificarea autenticitatii paginii
// Parametrii: 				$page_msg - pagina in care sunt generate mesajele de autentificare (implicit = index.php)
// Returneaza:				redirectare
// Uz: 						in procesul de autentificare
// --------------------------------------------------------------------------------------------------
function verify_page_location($page_msg="index.php") {
	$server_referer_name = @eregi_replace("^(.{2,6}://)?([^/]*)?(.*)", "\\2", $_SERVER['HTTP_REFERER']);
	$server_referer_ip = @gethostbyname($server_referer_name);				
	$server_name = $_SERVER['SERVER_NAME'];
	$server_ip = @gethostbyname($server_referer_name);

	if($server_referer_name != $server_name) {
		header("Location: ".$page_msg."?reason=failure&error=4");
		exit();
	}
}
// --------------------------------------------------------------------------------------------------


// CHECK_ADMIN_LOGIN:	functie utila pentru verificarea autentificarii unui user si mentinerea sesiunii
// Parametrii: 			$table - tabela in care se cauta user-ul pentru autentificare
//						$array_session - vector ce contine numele campurilor care se vor extrage din tabela 
// 						si vor fi stocate in variabilele de sesiune pentru prelucrarea anterioara
// 						ATENTIE: obligatoriu prima valoare din sirul $array_session este 
// 								 numele variabilei user din tabela, a 2-a variabila este numele variabilei pass
// 								 utilizate pentru verificarea autentificarii
//						$var_user - numele variabilei user-ului din formularul de autentificare, 
// 						trimisa prin POST (implicit = user)
//						$var_pass - numele variabilei parolei din formularul de autentificare, 
// 						trimisa prin POST (implicit = pass)
// 						$page_logout - pagina de iesire in cazul erorii de autentificare (implicit = index.php)
// 						$page_msg - pagina in care sunt generate mesajele de autentificare (implicit = index.php)
// 						$page_home - pagina in care va fi redirectat user-ul in caz de succes la autentificare (implicit = home.php)
// 						$query - este interogarea optionala lansata de utilizator (optional)
// Returneaza:			redirectare
// Uz: 					la procesul de autentificare
// --------------------------------------------------------------------------------------------------
function check_admin_login($table, $array_session, $var_user="user", $var_pass="pass", $page_logout="index.php", $page_msg="index.php", $page_home="home.php", $query="") {	
	// setarea variabilelor sosite empty :
	$var_user = (empty($var_user)) ? "user" : $var_user;
	$var_pass = (empty($var_pass)) ? "pass" : $var_pass;
	$page_logout = (empty($page_logout)) ? "index.php" : $page_logout;
	$page_msg = (empty($page_msg)) ? "index.php" : $page_msg;
	$page_home = (empty($page_home)) ? "home.php" : $page_home;
	
	// se ia query-ul, daca este cazul :
	if(!empty($query)) {
		$query_select = $query;
	} else {
		// se face selectia campurilor dorite:
		$selected_fields = "";
		for($i=0;$i<count($array_session);$i++) {
			$selected_fields .= $array_session[$i].',';
		}
		$selected_fields = substr_replace($selected_fields, '', strrpos($selected_fields, ","));
		
		$query_select = "SELECT ".$selected_fields." FROM ".$table." WHERE ".$array_session[0]."='".@$_POST[$var_user]."' AND ".$array_session[1]."='".md5(@$_POST[$var_pass])."'";
	}
	
	// se efectueaza operatiunea de logout :
	if(!empty($_GET['reason']) && ($_GET['reason']=="logout")) {
		session_unset();
		session_destroy();
		header("Location: ".$page_logout);
		exit();
	}
	
	// verificare username-ului si a parolei :
	if(empty($_SESSION["sess_".$array_session[0]])) {
		if(!isset($_POST[$var_user]) && !isset($_POST[$var_pass])) {
			header("Location: ".$page_logout);
			exit();
		} else {
			if(!empty($_POST[$var_user]) && !empty($_POST[$var_pass])) {
				// se verifica ca refere-ul din care se intra in site sa fie de pe server-ul in cauza:
				$this->verify_page_location($page_msg);
				
				// se verifica daca parola si username-ul sunt corecte :
				$rez = $this->select_fields($table, $query_select, $array_session, "", "", "", "", "", 1);
				
				if($this->get_num_rows($table, $query_select)==1) {
					$_SESSION["sess_".$array_session[0]] = $_POST[$var_user];
					
					if(count($array_session)>2) {
						for($i=2;$i<count($array_session);$i++)
							$_SESSION["sess_".$array_session[$i]] = $rez[$array_session[$i]];
					}
					
					header("Location: ".$page_home);
					exit();
				} else {
					// error: Invalid username or password!
					header("Location: ".$page_msg."?reason=failure&error=1");
					exit();
				}
			} else {
				// error: Please fill in both fields!
				header("Location: ".$page_msg."?reason=failure&error=2");
				exit();
			}
		}
	} else {
		session_destroy();
		// se verifica daca variabila user-ului din sesiune este parte din baza de date:
		if(($_SERVER['REQUEST_METHOD']=="POST") && (@$_POST['page']=="index") && $this->get_num_rows($table, "SELECT ".$selected_fields." FROM ".$table." WHERE ".$array_session[0]."='".$_SESSION["sess_".$array_session[0]]."'")==1) {
			// error: Session was distroyed!
			header("Location: ".$page_msg."?reason=failure&error=3");
			exit();
		} else {
			if(empty($_POST[$var_user]) || empty($_POST[$var_pass])) {
				header("Location: ".$page_msg."?reason=failure&error=2");
				exit();
			} else {
				header("Location: ".$page_msg."?reason=failure&error=3");
				exit();
			}
		}
	}
}
// --------------------------------------------------------------------------------------------------


// CHECK_ADMIN_SESSION_LOGIN:	
// functie utila pentru verificarea autentificarii unui user si mentinerea sesiunii prin intermediul 
// unei tabele in care sunt retinute sesiunile se autentificare
// Parametrii: 			$table - tabela in care se cauta user-ul pentru autentificare
// 						$table_session - tabela in care sunt retinute sesiunile de autentificare
// 						$login_type - user sau admin, functie de ce autentificare se face
//						$array_config - vector ce contine numele campurilor care se vor extrage din tabela 
// 						config si vor fi stocate in variabilele de sesiune pentru prelucrarea anterioara
// 						$array_session - campurile din tabela session care contin valorile utilizatorului autentificat
// 						ATENTIE: obligatoriu prima valoare din sirul $array_session este 
// 								 numele variabilei user din tabela, a 2-a variabila este numele variabilei pass
// 								 utilizate pentru verificarea autentificarii
//						$var_user - numele variabilei user-ului din formularul de autentificare, 
// 						trimisa prin POST (implicit = user)
//						$var_pass - numele variabilei parolei din formularul de autentificare, 
// 						trimisa prin POST (implicit = pass)
// 						$page_logout - pagina de iesire in cazul erorii de autentificare (implicit = index.php)
// 						$page_msg - pagina in care sunt generate mesajele de autentificare (implicit = index.php)
// 						$page_home - pagina in care va fi redirectat user-ul in caz de succes la autentificare (implicit = home.php)
// 						$max_user_time - timul maxim ptr care un user este lasat sa stea in aplicatie
// 						$query - este interogarea optionala lansata de utilizator (optional)
// 						$return - este 1 sau 2, daca se doreste ca metoda sa returneze un rezultat
// 								- 1 - se returneaza un string - ok sau wrong
// 								- 2 - se returneaza un vector cu rezultatul si pagina specifica ptr redirectare
// Returneaza:			redirectare, sau un vector in cazul in care parametrul return=2
// Uz: 					la procesul de autentificare
// --------------------------------------------------------------------------------------------------
function check_session_login($table, $array_config, $array_session, $login_type, $table_session="session", $var_user="user", $var_pass="pass", $page_logout="index.php", $page_msg="index.php", $page_home="home.php", $query="", $max_user_time=600, $return="") {
	// stabilirea parametrilor de prelucrare a datelor:
	$this->sid = session_id(); 		// id sesiune
	$ip = $_SERVER['REMOTE_ADDR']; 	// ip PC
	$time = time(); 				// timp prezent
	$this->time = $time;
	$user_guest = "guest";			// numele user-ului care nu e logat
	
	// setarea variabilelor sosite empty :
	$table_session = (empty($table_session)) ? "session" : $table_session;
	$var_user = (empty($var_user)) ? "user" : $var_user;
	$var_pass = (empty($var_pass)) ? "pass" : $var_pass;
	$page_logout = (empty($page_logout)) ? "index.php" : $page_logout;
	$page_msg = (empty($page_msg)) ? "index.php" : $page_msg;
	$page_home = (empty($page_home)) ? "home.php" : $page_home;
	$max_user_time = (empty($max_user_time)) ? 600 : $max_user_time;

	// se ia query-ul, daca este cazul :
	if(!empty($query)) {
		$query_select = $query;
	} else {
		// se face selectia campurilor dorite:
		$selected_fields = "";
		for($i=0;$i<count($array_config);$i++) {
			$selected_fields .= $array_config[$i].',';
		}
		$selected_fields = substr_replace($selected_fields, '', strrpos($selected_fields, ","));
		
		if (isset($_POST[$var_user]) && isset($_POST[$var_pass]))
			$query_select = "SELECT ".$selected_fields." FROM ".$table." WHERE ".$array_config[0]."='".@$_POST[$var_user]."' AND ".$array_config[1]."='".md5(@$_POST[$var_pass])."'";
	}
	
	// se sterg inregistrarile din SESSION ce au timpul mai mare decat cel stabilit si care au user_id="" :
	$this->delete_field($table_session, "", "", "", $table_session."_time<(UNIX_TIMESTAMP()-".$max_user_time.") OR ".$table_session."_".$array_session[0]."=''");
	
	// Logout :
	if(!empty($_GET['reason']) && @$_GET['reason']=="logout") {
		session_unset();
		session_destroy();
		
		// se sterg din tabela session userii care au parasit sesiunea
		$this->delete_field($table_session, "", "", "", $table_session."_sid='".$this->sid."' AND ".$table_session."_ip='".$ip."'");
		
		if($return==1) {
			$array_return = "wrong";
			return $array_return;
		} elseif($return==2) {
			$array_return['result'] = "wrong";
			$array_return['redirect'] = $page_logout;
			return $array_return;
		} else {
			header("Location: ".$page_logout);
			exit();
		}
	}
	
	// Login : (autentificare user)
	if(isset($_POST[$var_user]) && !empty($_POST[$var_user]) && isset($_POST[$var_pass]) && !empty($_POST[$var_pass])) {

		// se verifica ca refere-ul din care se intra in site sa fie de pe server-ul in cauza :
//COMENTAT PENTRU TEST LOCAL		
//		if(empty($return))
//			$this->verify_page_location($page_msg);
//		$rez = $this->select_fields($table, $query_select, $array_config, "", "", "", "", "", 1);
//COMENTAT PENTRU TEST LOCAL		
		
		if($this->get_num_rows($table, $query_select)==1) {
			$_SESSION["sess_".$array_session[0]] = @$_POST[$var_user];
			
			if(count($array_config)>2) {
				for($i=2;$i<count($array_config);$i++)
					$_SESSION["sess_".$array_config[$i]] = $rez[$array_config[$i]];
			}
			
			// in cazul in care se specifica mai multe valori in vectorul $array_session :
			$update = $insert_fields = $insert_values = "";
			if(count($array_session)>2) {
				$update = $insert_fields = $insert_values = ",";
				for($i=2;$i<count($array_session);$i++) {
					$update .= $table_session."_".$array_session[$i]."='".$rez[$array_config[$i]]."',";
					$insert_fields .= $table_session."_".$array_session[$i].',';
					$insert_values .= "'".$rez[$array_config[$i]]."',";
				}
				$_SESSION['sess_update'] = substr($update,0,strlen($update)-1);
				$_SESSION['sess_insert_fields'] = substr($insert_fields,0,strlen($insert_fields)-1);
				$_SESSION['sess_insert_values'] = substr($insert_values,0,strlen($insert_values)-1);
			}
			
			// verificare daca user-ul este pe guest :
			$query = "SELECT * FROM ".$table_session." WHERE ".$table_session."_sid='".$this->sid."'";
			if($this->get_num_rows($table_session, $query)===1) {
				$query_update = "UPDATE ".$table_session." 
								SET ".$table_session."_".$array_session[0]."='".$_SESSION["sess_".$array_session[0]]."', 
									".$table_session."_time='".$time."'".@$_SESSION['sess_update']."
								WHERE ".$table_session."_sid='".$this->sid."' AND 
									  ".$table_session."_ip='".$ip."'";
				$this->query($query_update);
			} else {
				$query_insert = "INSERT INTO ".$table_session." (".$table_session."_sid, ".$table_session."_".$array_session[0].", ".$table_session."_ip, ".$table_session."_time, ".$table_session."_time_start ".@$_SESSION['sess_insert_fields'].") 
								 VALUES ('".$this->sid."','".$_SESSION["sess_".$array_session[0]]."','".$ip."','".$time."','".$time."' ".@$_SESSION['sess_insert_values'].")";
				$this->query($query_insert);
			}
			
			if($return==1) {
				$array_return = "ok";
				return $array_return;
			} elseif($return==2) {
				$array_return['result'] = "ok";
				$array_return['redirect'] = $page_home;
				return $array_return;
			} else {
				echo '<script type="text/javascript">document.location.href="'.$page_home.'";</script>';
				/*
				header("Location: ".$page_home);
				exit();
				*/
			}
		} else {
			// error: Invalid username or password!
			if($return==1) {
				$array_return = "wrong";
				return $array_return;
			} elseif($return==2) {
				$array_return['result'] = "wrong";
				$array_return['redirect'] = $page_msg."?reason=failure&error=1";
				return $array_return;
			} else {
				header("Location: ".$page_msg."?reason=failure&error=1");
				exit();
			}
		}
	}
	
	// se verifica daca user-ul este online :
	if(empty($_SESSION["sess_".$array_session[0]])) {
		// in cazul in care se face login-area unui user :
		if($login_type=="user") {
			// punere user pe guest in cazul in care este un simplu navigator :
			$query = "SELECT * FROM ".$table_session." WHERE ".$table_session."_sid='".$this->sid."' AND ".$table_session."_ip='".$ip."'";
			if($this->get_num_rows($table_session, $query)==0) {
				$query_insert = "INSERT INTO ".$table_session." (".$table_session."_sid, ".$table_session."_".$array_session[0].", ".$table_session."_ip, ".$table_session."_time, ".$table_session."_time_start ".@$_SESSION['sess_insert_fields'].") 
								 VALUES ('".$this->sid."','".$user_guest."','".$ip."','".$time."','".$time."' ".@$_SESSION['sess_insert_values'].")";
				$this->query($query_insert);
			} else {
				$query_update = "UPDATE ".$table_session." 
								 SET ".$table_session."_time='".$time."' ".@$_SESSION['sess_update']."
								 WHERE ".$table_session."_sid='".$this->sid."' AND 
								 	   ".$table_session."_".$array_session[0]."='".$user_guest."' AND 
									   ".$table_session."_ip='".$ip."'";
				$this->query($query_update);
			}
		} else {
			// se sterg din tabela session userii care au parasit sesiunea
			$this->delete_field($table_session, "", "", "", $table_session."_sid='".$this->sid."' AND ".$table_session."_ip='".$ip."'");		
			
			// error: Session was distroyed!
			if($return==1) {
				$array_return = "wrong";
				return $array_return;
			} elseif($return==2) {
				$array_return['result'] = "wrong";
				$array_return['redirect'] = $page_msg."?reason=failure&error=3";
				return $array_return;
			} else {
				if(empty($_POST[$var_user]) || empty($_POST[$var_pass])) {
					header("Location: ".$page_msg."?reason=failure&error=2");
					exit();
				} else {
					header("Location: ".$page_msg."?reason=failure&error=3");
					exit();
				}
			}
		}
	} else {
		// se intretine tabela session cu userii care sunt logati :
		if($this->exist_value($table_session, $table_session.'_'.$array_session[0], $_SESSION["sess_".$array_session[0]])==0) {
			$query_insert = "INSERT INTO ".$table_session." (".$table_session."_sid, ".$table_session."_".$array_session[0].", ".$table_session."_ip, ".$table_session."_time, ".$table_session."_time_start ".@$_SESSION['sess_insert_fields'].") 
							 VALUES ('".$this->sid."','".$_SESSION["sess_".$array_session[0]]."','".$ip."','".$time."','".$time."' ".@$_SESSION['sess_insert_values'].")";
			$this->query($query_insert);
		} else {
			$query_update = "UPDATE ".$table_session." 
							 SET ".$table_session."_".$array_session[0]."='".$_SESSION["sess_".$array_session[0]]."', 
							 	 ".$table_session."_time='".$time."' ".@$_SESSION['sess_update']." 
							 WHERE ".$table_session."_sid='".$this->sid."' AND 
							 	   ".$table_session."_ip='".$ip."'";
			$this->query($query_update);
		}
		
		if($return!=1 && $return!=2) {
			if((empty($_POST[$var_user]) || empty($_POST[$var_pass])) && empty($_SESSION["sess_".$array_session[0]])) {
				header("Location: ".$page_msg."?reason=failure&error=2");
				exit();
			}
		}
	}
}
// --------------------------------------------------------------------------------------------------


// GENERATE_JS_ARRAY:	genereaza un array de tip JS ce contine datele unei coloane dintr-o tabela
// Parametrii: 			$table - tabela din baza de date
// 						$table_field - campul din care se extrag datele
// 						$field_order - campul dupa care se face ordonarea datelor
// 						$query - query-ul asupra caruia se aplica functia (optional)
// 						$where - este conditia care se impune interogarii (optional)
// Returneaza:			un string ce contine array-ul JS dorit
// Uz: 					in cazul unor prelucrari JS
// --------------------------------------------------------------------------------------------------
function generate_js_array($table, $table_field, $field_order="", $query="", $where="") {
	$query_select = "";
	if(!empty($query)) {
		$query_select = $query;
	} else {
		$where_condition =  !empty($where) ? $where : "";
		$query_select = "SELECT ".$table_field." FROM `".$table."` WHERE ".$where_condition;
	}
	
	if(!empty($field_order))
		$query_select .= " ORDER BY ".$field_order;
	
	$array_select = $this->select_field($table, $table_field, "", $query_select);
	
	$array_js = "Array(";
	for($i=0; $i<count($array_select); $i++) {
		$array_js .= "'".replace_special_chars(trim(stripslashes($array_select[$i])))."',";
	}
	$array_js = substr($array_js, 0, (strlen($array_js)-1)).");\n";
	
	return $array_js;
}
// --------------------------------------------------------------------------------------------------
function mysqlinsertid () {
	return mysql_insert_id($this->Link_ID);
	}

}
// --------------------------------------------------------------------------------------------------
// x3_database CLASS - END --------------------------------------------------------------------------
?>