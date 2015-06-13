<?
// clasa care realizeaza diverse operatii si permit legatura intre clase
// x3_utils CLASS - START ---------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
class x3_utils {

var $total_pag 	= 0;			// nr total de pagini dintr-o afisare
var $nr_pag		= 0;			// nr pagini curente din afisare


// SET_VAR:			setarea unei variabile la o anumita valoare dorita trimisa prin GET
// Parametrii: 		&$var - varibila din fisierul sursa care se seteaza
// 					$var_name - numele variabilei
// 					$implicit_value - valoarea implicita care o ia variabila
// Returneaza:		functia nu returneaza nimic, doar modifica valoarea variabilei trimise
// Uz: 				la generarea de rezultate pe mai multe pagini
// --------------------------------------------------------------------------------------------------
function set_get_var(&$var, $var_name, $implicit_value) {
	//(!isset($var) && !isset($_GET[$var_name]))?$var = $implicit_value:$var = @$_GET[$var_name];
	//(!isset($_GET[$var_name]))?$var = $implicit_value:$var = @$_GET[$var_name];
	(empty($_GET[$var_name]))?$var = $implicit_value:$var = @$_GET[$var_name];
}
// --------------------------------------------------------------------------------------------------


// SET_EMPTY_VAR:	setarea unei variabile goale la o anumita valoare dorita
// Parametrii: 		$var - varibila din fisierul sursa care se seteaza
// 					$var_value - noua valoare a variabilei
// Returneaza:		functia nu returneaza nimic, doar modifica valoarea variabilei trimise
// Uz: 				la generarea de rezultate pe mai multe pagini
// --------------------------------------------------------------------------------------------------
function set_empty_var($var, $var_value) {
	if(empty($var))
		$var = $var_value;
	
	return $var;
}
// --------------------------------------------------------------------------------------------------


// GENERATE_URL:	generarea unui url catre care se face accesarea
// Parametrii: 		$text_link - textul care se asociaza link-ului
// 					$link - link-ul initial de la care se pleaca
//					$array_vars - sirul de variabile catre care se face accesarea
//					$options - sirul de variabile optiuni(daca sunt optiuni diferite de navigare) (optional)
// 					$var_option_name - numele variabilei optiune (optional)
// 					$class_link - clasa css asociata link-ului (optional)
// 					$icon - calea catre icoana, daca se doreste atasarea unei icoane (optional)
// 					$align - alinierea fata de icoana (otional) - are atributele alinierii fata de o imagine
// 					$return - este 1 in cazul in care se doreste ca metoda sa nu returneze un link
// 					$butform - este 1 in cazul in care se doreste construirea unui buton de formular (optional)
//					$method - metoda cu care se face trimiterea formularului (implicit = POST)
// 					$other_fields - alte campuri de tip HTML care se trimit prin formularul format (optional)
// Returneaza:		noul link catre care se face accesarea (sub forma de string sau array-cazul optiunilor)
// Uz: 				la navigarea intre paginile cu rezultate generate
// --------------------------------------------------------------------------------------------------
function generate_url($text_link, $link, $array_vars, $options="", $var_option_name="option", $class_link="", $icon="", $align="", $return="", $butform="", $method="POST", $other_fields="") {
	// validarea variabilelor :
	!empty($class_link) ? $class='class="'.$class_link.'"' : $class="";
	!empty($align) ? $align='align="'.$align.'"' : $align="";
	
	$url = $link;
	!strstr($link, '?')?$url.='?':$url.="";
	
	foreach($array_vars as $key => $val) {
		$url .= $key.'='.$val.'&';
	}
	$url = substr($url,0,strlen($url)-1);
	
	if(!empty($options)) {
		foreach($options as $key => $val) {
			$url_array[$val] = $url."&".$var_option_name."=".$val;
		}
	} else {
		if(empty($butform)) {
			$link_start = '<a href="'.$url.'" '.$class.'>';
			$link_stop = '</a>';
			!empty($icon) ? $link_icon=$link_start.'<img src="'.$icon.'" alt="" border="0" '.$align.'>'.$link_stop : $link_icon='';
		} else {
			$link_start = '<form action="'.$url.'" method="'.$method.'">';
			$link_stop = '</form>';
			$text_link = $other_fields.'<input name="but" type="Submit" value="'.$text_link.'" class="butform">';
		}
		
		if($return==1)
			$url_array = $url;
		else
			$url_array = @$link_icon.' '.$link_start.$text_link.$link_stop;
	}
	
	return $url_array;
}
// --------------------------------------------------------------------------------------------------


// RECONSTRUCT_GET_URL:		reconstituirea unui url catre care se face accesarea
// Parametrii: 				$link - link-ul initial de la care se pleaca
//							$var - valoarea variabilei care se doreste modificata
// 							$var_name - numele variabilei(existente) care se modifica
// 							$var_ignore - numele variabilei care se ignora
// Returneaza:				noul link catre care se face accesarea
// Uz: 						la navigarea intre paginile care afiseaza tabele de ordonare
// --------------------------------------------------------------------------------------------------
function reconstruct_get_url($link, $var, $var_name, $var_ignore="") {
	$url = $link;
	!strstr($link, '?')?$url.='?':$url.="";
	
	foreach($_GET as $key => $val) {
		if($key!=$var_name && $key!=$var_ignore)
			$url .= $key.'='.$val.'&';
	}
	$url .= $var_name.'='.$var.'&';
	
	return substr($url,0,strlen($url)-1);
}
// --------------------------------------------------------------------------------------------------


// HEAD_TABLE:		genereaza capul de tabel ptr tabelul de generare al rezultatelor
// Parametrii: 		$fields - un sir de tipul ([nume camp tabela]=>[nume camp afisare site])
// 					$link - link-ul catre care se merge
// 					$var_order - numele variabilei de ordonare
// 					$implicit_order_var - valoare implicita a variabilei de ordonare
// 					$class_link - clasa standard a link-ului
// 					$class_link_select - clasa link-ului in caz de ordonare
// 					$arrow_up - calea catre imaginea sageata sus (ordonare crescatoare)
// 					$arrow_down - calea catre imaginea sageata jos (ordonare descrescatoare)
// Returneaza:		un array cu link-urile capului de tabel
// Uz: 				la generarea rezultatelor
// --------------------------------------------------------------------------------------------------
function head_table($fields, $link, $var_order, $implicit_order_var="", $class_link="", $class_link_select="", $arrow_up="../WEB-INF/assets/images/icons/arrow_up.png", $arrow_down="../WEB-INF/assets/images/icons/arrow_down.png") {
	empty($_GET[$var_order]) ? $var_compare=$implicit_order_var : $var_compare=$_GET[$var_order];
	
	foreach($fields as $key => $val) {
		$class = (stristr($var_compare, $key)!="") ? $class_link_select : $class_link;
		$head[$key] = '
				<table width="100%" cellpadding="0" cellspacing="0" border="0">
				<tr>
					<td><a href="'.$this->reconstruct_get_url($link, ($key), $var_order, "message").'" class="'.$class.'">'.$val.'</a></td>
					<td width="10">
						<table width="100%" cellpadding="0" cellspacing="0" border="0">
							<tr><td><a href="'.$this->reconstruct_get_url($link, ($key), $var_order, "message").'|ASC"><img src="'.$arrow_up.'" alt="" title="Sort Ascending" border="0"></a></td></tr>
							<tr><td height="3"></td></tr>
							<tr><td><a href="'.$this->reconstruct_get_url($link, ($key), $var_order, "message").'|DESC"><img src="'.$arrow_down.'" alt="" title="Sort Descending" border="0"></a></td></tr>
						</table>
					</td>
				</tr>
				</table>';
	}
	
	return $head;
}

function head_table_new($fields, $link, $var_order, $implicit_order_var="", $class_normal="", $class_up="", $class_down) {
	empty($_GET[$var_order]) ? $var_compare=$implicit_order_var : $var_compare=$_GET[$var_order];
	//print $var_compare;
	list($order_field,$type) = explode("|",$var_compare);
	foreach($fields as $key => $val) {
		$class = (stristr($order_field, $key)!="") ? (($type=="ASC") ? $class_up : $class_down) : $class_normal;
		$head[$key] = ' class="'.$class.'"><a  id="tableheader" href="'.$this->reconstruct_get_url($link, ($key), $var_order, "message").'|'.($type=="ASC" ? "DESC" : "ASC").'">'.$val.'</a>';
	}
	return $head;
}
// --------------------------------------------------------------------------------------------------


// NAVIGATE:		genereaza navigarea intre paginile de rezultate generate
// Parametrii: 		$total_articles - nr total de articole care se vor afisa
// 					$start - valoarea variabilei de navigare, functie de pagina curenta
// 					$per_page - nr de rezultate pe pagina (implicit = 10)
// 					$link - link-ul catre care se navigheaza
// 					$class_link - clasa css a link-ului (optional)
// 					$nr_pags - nr de pagini care va fi afisat tot timpul (implicit = 5)
// Returneaza:		string-ul elementelor de navigare
// Uz: 				la generarea paginilor cu rezultate
// --------------------------------------------------------------------------------------------------
function navigate_text($total_articles, $start, $per_page=10, $link, $class_link="", $nr_pags=5) {
	// se face generarea elementelor necesare ptr navigare :
	$total_pag 	= ceil($total_articles/$per_page); // nr total de pagini
	$nr_groups 	= ceil($total_pag/$nr_pags); // nr de grupuri de cate nr_pags pagini
	$page 		= ceil($start/$per_page); // nr paginii curente
	$group 		= ceil(($page + 1)/$nr_pags); // nr grupului de cate nr_pags pagini
	
	$this->total_pag = $total_pag;
	$this->nr_pag = $page + 1;
	
	// se seteaza numarul paginii de start :
	//$start_page = ($group-1)*$nr_pags; // pag de start - model vechi de navigare
	$start_page = $page - floor($nr_pags/2);
	if($start_page<0)
		$start_page = 0;
	if(($page>=$total_pag-floor($nr_pags/2)-1) && (floor($nr_pags/2)<$total_pag-1)) {
		if($total_pag < $nr_pags)
			$start_page = 0;
		else
			$start_page = $total_pag - $nr_pags;
	}
	
	// se seteaza numarul paginii de stop :
	//$stop_page = $nr_pags*$group; // pag de stop - model vechi de navigare
	$stop_page = $page + floor($nr_pags/2) + 1;
	if($page<floor($nr_pags/2))
		$stop_page = $nr_pags;
	if($stop_page>$total_pag)
		$stop_page = $total_pag;
	
	// se face generarea butoanelor de navigare :
	if($total_articles>=$per_page) {
		$but = ($start!=0)?('<a href="'.$this->reconstruct_get_url($link, ($start-$per_page), "start", "message").'" class="'.$class_link.'">Previous</a>&nbsp;&nbsp;'):('');
		if($total_pag>1) {
			for($i=$start_page;$i<$stop_page;$i++) {
				if($i!=$page){
					$but .= '<a href="'.$this->reconstruct_get_url($link, ($i*$per_page), "start", "message").'" class="'.$class_link.'">'.($i+1).'</a>&nbsp;&nbsp;';
				} else {
					$but .= '<strong class="textred">['.($i+1).']</strong>&nbsp;&nbsp;';
				}
			}
		}
		$but .= ($start!=($total_pag-1)*$per_page && $total_articles>0)?('<a href="'.$this->reconstruct_get_url($link, ($start+$per_page), "start", "message").'" class="'.$class_link.'">Next</a>'):('');
	}
	
	return @$but;
}

/*SAMUEL CODE STARTS HERE*/
function navigate_text_new($total_articles, $start, $per_page=10, $link, $class_link="", $nr_pags=5) {
	// se face generarea elementelor necesare ptr navigare :
	/*echo $total_articles.'<br>'.$per_page.'<br>';
	exit();*/
	
	$total_pag 	= ceil($total_articles/$per_page); // nr total de pagini
	$nr_groups 	= ceil($total_pag/$nr_pags); // nr de grupuri de cate nr_pags pagini
	$page 		= ceil($start/$per_page); // nr paginii curente
	$group 		= ceil(($page + 1)/$nr_pags); // nr grupului de cate nr_pags pagini
	$total_page = ($total_pag-1)*$per_page;
	
	$this->total_pag = $total_pag;
	$this->nr_pag 	 = $page + 1;
	
	// se seteaza numarul paginii de start :
	//$start_page = ($group-1)*$nr_pags; // pag de start - model vechi de navigare
	$start_page = $page - floor($nr_pags/2);
	if($start_page<0)
		$start_page = 0;
	if(($page>=$total_pag-floor($nr_pags/2)-1) && (floor($nr_pags/2)<$total_pag-1)) {
		if($total_pag < $nr_pags)
			$start_page = 0;
		else
			$start_page = $total_pag - $nr_pags;
	}
	
	// se seteaza numarul paginii de stop :
	//$stop_page = $nr_pags*$group; // pag de stop - model vechi de navigare
	$stop_page = $page + floor($nr_pags/2) + 1;
	if($page<floor($nr_pags/2))
		$stop_page = $nr_pags;
	if($stop_page>$total_pag)
		$stop_page = $total_pag;
	
	// se face generarea butoanelor de navigare :
	if($total_articles>=$per_page) {
		$but = ($start!=0)?('<a href="'.$this->reconstruct_get_url($link, "0", "start", "message").'" class="'.$class_link.'">First</a>&nbsp;&nbsp;<a href="'.$this->reconstruct_get_url($link, ($start-$per_page), "start", "message").'" class="'.$class_link.'">Previous</a>&nbsp;&nbsp;'):('');
		if($total_pag>1) {
			for($i=$start_page;$i<$stop_page;$i++) {
				if($i!=$page){
					$but .= '<a href="'.$this->reconstruct_get_url($link, ($i*$per_page), "start", "message").'" class="'.$class_link.'">'.($i+1).'</a>&nbsp;&nbsp;';
				} else {
					$but .= '<strong class="textred">['.($i+1).']</strong>&nbsp;&nbsp;';
				}
			}
		}
		$but .= ($start!=($total_pag-1)*$per_page && $total_articles>0)?('<a href="'.$this->reconstruct_get_url($link, ($start+$per_page), "start", "message").'" class="'.$class_link.'">Next</a>&nbsp;&nbsp;<a href="'.$this->reconstruct_get_url($link, $total_page, "start", "message").'" class="'.$class_link.'">Last</a>'):('');
	}
	
	return @$but;
}
// --------------------------------------------------------------------------------------------------

// SET_HEADER:	setarea unui header la o pagina web
// Parametrii: 	$content - continutul header-ului
// 				$type - tipul header-ului
// Returneaza:	functie permite setarea unui header la o pagina web
// Uz: 			la generarea de headere
// --------------------------------------------------------------------------------------------------
function set_header($content, $type) {
	Header("Content-type: ".$content."/".$type);
}
// --------------------------------------------------------------------------------------------------

}
// x3_utils CLASS - END -----------------------------------------------------------------------------
?>