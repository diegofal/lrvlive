<?
// clasa care realizeaza trimiterea unui mail :
// aceasta clasa face extinderea clasei principale de trimire a mail-urilor
// x3_mail CLASS - START ----------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
$path = "";
if(strstr(session_name(),"cms")!=FALSE) {
	$path = "../";
}
require_once $path."WEB-INF/includes/mail/mail_class/htmlMimeMail.php";

class x3_mail extends htmlMimeMail {

// SEND_MAIL: 		trimite un mail de tip html/txt functie de tipul clientului de mail utilizat
// Parametrii: 		$file_html - calea catre fiserul html care se trimite
// 					$file_txt - calea catre fiserul txt care se trimite
// 					$img_dir - calea catre directorul cu imagini
// 					$subject - subiectul mail-ului
// 					$addr_from - adresa de unde vine mail-ul
// 					$addr_to - adresele care care se trimite mail-ul
// Returneaza:		1 TRUE, 0 FALSE
// Uz: 				la trimiterea de mail-uri
// --------------------------------------------------------------------------------------------------
function send_mail($file_html, $file_txt, $img_dir, $subject, $addr_from, $addr_to) {
	// setare director unde e gasit fis html si txt :
	$html = $this->getFile($file_html);
	$text = $this->getFile($file_txt);
	
	// setare mail :
	$this->setHtml($html, $text, $img_dir);
	
	// setarea adresa trimitere si subiect :
	$this->setFrom($addr_from);
	$this->setReturnPath($addr_from);
	$this->setSubject($subject);
	
	//ADD BY CALIN
	$this->setBcc(implode(', ', $addr_to));
	
	// trimiterea mail-ului :
	//if($this->send($addr_to, "mail"))
	if($this->send(array(), "mail"))
		return 1;
	else
		return 0;
}
// --------------------------------------------------------------------------------------------------
}
// --------------------------------------------------------------------------------------------------
// x3_mail CLASS - END --------------------------------------------------------------------------
?>