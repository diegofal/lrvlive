<?

die("We sorry, we have a temporary problem. Please contact us to bookings@londonribvoyages.com.");
// accesare clasa si fonturi :
define('FPDF_FONTPATH','../WEB-INF/includes/classes/font/');
require('../WEB-INF/includes/classes/class.pdf.php');

// se porneste generarea paginii graficului :
class PDF extends FPDF {
    var $B;
    var $I;
    var $U;
    var $HREF;
    var $CENTER;
    
    var $id;
    var $text_top;
    var $text_footer;
    var $img_path;
    
    // functie de setarea a variabilelelor utile :
    // ----------------------------------------------------------------------------------------------------
    function SetVars() {
        global $_GET;
        $this->id = $_GET['code'];          // id-ul user-ului seledctat
        $this->img_path = "../WEB-INF/assets/images/utils/logo_pdf.jpg"; // calea logo-ului
    }
    // ----------------------------------------------------------------------------------------------------
    
    // functii FPDF ptr scrierea de tip HTML :
    // ----------------------------------------------------------------------------------------------------
    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF) {
                    $this->PutLink($this->HREF,$e);
                } elseif($this->CENTER) {
                    $this->Ln(2);
                    $this->MultiCell(200, 2, $this->CENTER, 0, 'C', 0);
                } else {
                    $this->Write(5, $e);
                }
            }
            else
            {
                //Tag
                if($e{0}=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract attributes
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $attr=array();
                    foreach($a2 as $v)
                        if(ereg('^([^=]*)=["\']?([^"\']*)["\']?$',$v,$a3))
                            $attr[strtoupper($a3[1])]=$a3[2];
                    $this->OpenTag($tag, $attr, $a[2]);
                }
            }
        }
    }
    
    function OpenTag($tag, $attr, $text="")
    {
        //Opening tag
        if($tag=='B' or $tag=='I' or $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF = $attr['HREF'];
        if($tag=='CENTER')
            $this->CENTER = $text;
        if($tag=='BR')
            $this->Ln(5);
    }
    
    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' or $tag=='I' or $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='CENTER')
            $this->CENTER='';
    }
    
    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->SetFont('',$style);
    }
    
    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
    // ----------------------------------------------------------------------------------------------------
    
    // functie de setare a culorilor de scriere si desenare :
    // ----------------------------------------------------------------------------------------------------
    function SetColor() {
        $this->SetFillColor(255,255,255);
        $this->SetTextColor(0);
        $this->SetDrawColor(200,200,200);
        $this->SetLineWidth(.1);
    }
    // ----------------------------------------------------------------------------------------------------
    
    // setarea footer-ului din pagina :
    // ----------------------------------------------------------------------------------------------------
    function Footer() {
        $this->SetY(-15);
        
        $this->SetFont('Arial', 'B', 12);
        $this->SetTextColor(140, 140, 140);
        $this->Cell(0, 10, $this->text_footer, 0, 0, 'C');
    }
    // ----------------------------------------------------------------------------------------------------
    
    // functie de generare a etichetelor mari :
    // ----------------------------------------------------------------------------------------------------
    function FancyEntrees() {
        // se iau dimensiunile imaginii :
        $imagesize = getimagesize($this->img_path);
        $img_w = $imagesize[0];
        $img_h = $imagesize[1];
        $img_factor = 5;
        //image
        $this->Image($this->img_path, 155, 10, ceil($img_w/$img_factor), ceil($img_h/$img_factor));


        require_once "../WEB-INF/includes/classes/class.x3.database.php";
        require_once "../WEB-INF/includes/config.php";

        // DB connction
        $db = new DB_config;
        $db->connect();
        $query = "SELECT * FROM $db->order, $db->departure, $db->boat, $db->tour
                  WHERE  order_departure_id = departure_id
                  AND departure_boat_id = boat_id
                  AND departure_tour_id = tour_id
                  AND order_unique_code = '".$this->id."'";
        $fields = array("order_id","order_date","order_unique_code","order_title","order_first_name","order_last_name",
                    "order_street_address1", "order_street_address2", "order_city", "order_zip", "order_country",
                    "order_phone", "order_email", "order_tickets", "order_quantities", "order_total", 
                    "departure_date", "departure_time", "boat_name");
        $order = $db->select_fields($db->order, $query, $fields, "", "", "", "", "", 1);
        
        if(empty($order['order_id'])) die('This thicket does not exist!');
        
        $this->SetXY(20, 15);
        $this->SetFont('Arial', 'B', 11);
        $this->WriteHTML("Billing Name and Address:<br>");
        $this->SetFont('Arial', '', 12);
        $this->WriteHTML($order['order_first_name']." ".$order['order_last_name']."<br>");
        /*$this->WriteHTML($order['order_street_address1']." ".$order['order_street_address2']."<br>");
        $this->WriteHTML($order['order_city']."<br>");
        $this->WriteHTML($order['order_zip']."<br>");
        $this->WriteHTML(@$COUNTRIES[$order['order_country']]."<br>");*/
        $this->WriteHTML($order['order_phone']."<br>");
        $this->SetFont('Arial', 'U', 11);
        $this->WriteHTML($order['order_email']."<br><br>");

        $this->SetFont('Arial', '', 11);
        $this->WriteHTML("Booking Date: ".date("m.d.Y",strtotime($order['order_date']))."<br>");
        $this->WriteHTML("Booking Code: ".$order['order_id']."<br>");

        $this->WriteHTML("Boat Name:<br>");
        $this->WriteHTML("Date of Voyage:<br>");
        $this->WriteHTML("Departure Time:<br>");
        
        $tickets_type = explode("|", $order['order_tickets']);
        $tickets_nr = explode("|", $order['order_quantities']);


        $tickets = $db->select_fields($db->ticket);

        $tmp = array ('ticket_id' => 0,  'ticket_type' => 'Charter',  'ticket_price' => $order['order_total'],  'ticket_del' => 0 );
        $tickets[] = $tmp;
        
        foreach($tickets as $ticket){
            if (in_array($ticket['ticket_id'],$tickets_type)) $this->WriteHTML($ticket['ticket_type'].":<br>");
        }
        $this->WriteHTML("Total Cost:<br>");

        $this->SetXY(62, 70);
        $this->WriteHTML("<b>". $order['boat_name']."</b><br>");
        $this->SetXY(62, 75);
        $this->WriteHTML("<b>".date("d F Y",strtotime($order['departure_date']))."</b><br>");
        $this->SetXY(62, 80);
        $this->WriteHTML("<b>".substr($order['departure_time'],0,5)."</b><br>");
        
        $pos = 85;
        $i=0;
        foreach($tickets_nr as $value){
            $i++;
            $this->SetXY(62, 80+$i*5);
            $this->WriteHTML("<b>".$value."</b><br>");
        }
        $this->SetXY(62, 85+$i*5);
        $this->WriteHTML("<b>�".$order['order_total']."</b><br><br>");


        $this->WriteHTML("<b>Directions</b><br>");
        $this->WriteHTML("Situated next to British Airways London Eye. Our ticket office is located at the entrance to the pier and is clearly signposted. Customers should meet here 15 minutes before sailing where you will be met by a member of staff. There are first class facilities within the British Airways London Eye building directly opposite providing refreshments, toilets and full facilities. There are first class outdoor facilities for eating and refreshments. Due to the small number of persons on sailings, there are no queues. <br><br>");

        $this->WriteHTML("<b>Tube</b><br>");
        $this->WriteHTML("Approximately five minutes walk from Waterloo tube station (follow signs for the South Bank) and Westminster Tube station (exit one and follow sign for Westminster Pier).<br><br>");
        
        $this->WriteHTML("<b>Rail</b><br>");
        $this->WriteHTML("Five minutes from Waterloo. Take exit six and follow signs for the South Bank. London River Voyages are next to the British Airways London Eye which is fifteen minutes from Charing Cross station and is accessed via the Hungerford Pedestrian Bridge.<br><br>");
        

        $this->WriteHTML("<b>Bus</b><br>");
        $this->WriteHTML("Buses to the British Airways London Eye include the 211, 24 and 11. It is in most London sightseeing tours and on the new RVI route that connects the British Airways London Eye to the Tate Modern and Covent Garden.<br><br>");
        
        $this->WriteHTML("<b>Coach</b><br>");
        $this->WriteHTML("See <u>www.tfl.gov.uk</u> for further details.<br><br>");
        
        $this->WriteHTML("<b>Car</b><br>");
        $this->WriteHTML("We advice against driving to the British Airways London Eye, but there are three car parks within walking distance around the South Bank area. <br><br>");

        $this->WriteHTML("<b>Air</b><br>");
        $this->WriteHTML("See <u>www.ba.com</u> for further details.  <br><br>");
        
        $this->SetFont('Arial', 'B', 9);
        $this->WriteHTML("If you have any questions, please feel free to contact us on 0207 928 2350 or 0207 401 8834. Alternatively you can email us at <u>bookings@londonribvoyages.com</u>");


    }
    // ----------------------------------------------------------------------------------------------------
}

$pdf = new PDF("P","mm","A4");
//$pdf->AddFont('Echelon','','our_fonts/echelon.php');
//$pdf->AddFont('Time','','our_fonts/time.php');
//$pdf->AddFont('Timebd','','our_fonts/timebd.php');
//$pdf->AddFont('Timesbi','','our_fonts/timesbi.php');
//$pdf->AddFont('Timesi','','our_fonts/timesi.php');
//$pdf->SetAutoPageBreak(0,0);

$pdf->SetVars();
$pdf->SetMargins(20,20);

$pdf->AddPage();
$pdf->FancyEntrees();

// ptr a face download la fisier :
$pdf->Output();
?>