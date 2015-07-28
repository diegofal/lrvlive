<?php
//error_reporting(E_ALL ^ E_NOTICE);
error_reporting(0);
// connecting class :
/*
	var $mysql_host		= "localhost";
	var $mysql_username	= "londonribvoyages";
	var $mysql_password	= "Egw7j6VECy";
	var $mysql_database	= "new_londonribvoyages";
*/

define("TESTING",true);

 //define("ROOT_PATH", "C:\\xampp\\htdocs\\lrvlive");
 define("ROOT_PATH", "/var/www/vhosts/lrvlive");
//define("ROOT_PATH", "/var/www/vhosts/new.londonribvoyages.com");

class DB_config extends x3_database {
	var $mysql_host		= "127.0.0.1";
	var $mysql_username	= "root"; //lrv-live
	//var $mysql_username	= "lrv-live"; //lrv-live
	var $mysql_password	= "Tl4358"; //mP9KXcTr9MYsxH8G
	//var $mysql_password	="mP9KXcTr9MYsxH8G";
	var $mysql_database	= "lrvlive"; //lrv-live
	//var $mysql_database	= "lrv-live"; //lrv-live

    //GENII
    var $email 			= "emails";
    var $tour           = "tours";
    var $voucher        = "vouchers";
    var $voucher_order  = "voucher_orders";
    var $package        = "packages";

    var $boat           = "boat";
    var $departure      = "departure";
    var $config         = "config";
    var $order          = "orders";
    var $page           = "page";
    var $subpage        = "subpage";
    var $session        = "session";
    var $ticket         = "ticket";
    var $resellers      = "resellers";
    var $reseller_offers    = "reseller_offers";
    var $reseller_cmns  = "reseller_cmns";
    var $reseller_tickets   = "reseller_tickets";
    var $reseller_offer_tickets   = "reseller_offer_tickets";
    var $skipper            = "skipper";
    var $guide              = "guide";
	var $tbl_newsletter_clients = "tbl_newsletter_clients";
	var $special_offer		= "special_offer";
	var $testimonials		= "testimonials";
	var $tbl_hear_about_us	= "tbl_hear_about_us";
}

// cms menu
$menu_cms = array("booking"=>array(
                        "calendar"=>"Calendar",
                        "tours"=>"Tours",
                        "code"=>"Search",
                        "orders"=>"Placed Orders",
						"deleted_orders"=>"Uncompl. Orders",
                        "template"=>"+ Depart.",
                        "packages"=>"Corp. Packs",
                        "excel"=>"Reports",
                        "vouchers"=>"Vouchers",
						"email_queue"=>"Search Mails"
                  ),

                  "editor"=>array(
                        "home"=>"Home",
                        "route"=>"Cruise",
						"special_offer"=>"Special Offer",
						"testimonial"=>"Testimonial",
						"hear_aboutus"=>"Hear About us",
						"about_us"=>"CMS Pages"
                        ),


                  "settings"=>array(
                        "boats"=>"Boats",
                        "tickets"=>"Tickets",
                        "resellers"=>"Resellers",
                        "reseller_offers"=>"Reseller Offers",
                        "change"=>"Change Password",
						"emails"=>"E-mail confirmations",
						"skipper"=>"Add a Skipper",
						"guide"=>"Add a Guide"
                        )
                    );
$menu_cms_pages  = array("about_us"=>"About Us",
							"location"=>"Location",
                        	"contact"=>"Contact Us",
                        	"terms"=>"Terms &amp; Conditions",
                         	"about_us_people_say"=>"What people say about us",
						 	"about_us_guides"=>"Meet our Guides",
							"about_us_guides_ben"=>"Meet our Guides : Ben",
							"about_us_guides_matt1"=>"Meet our Guides : MattI",
							"about_us_guides_mat2"=>"Meet our Guides : MattII",
							"about_us_guides_mike"=>"Meet our Guides : Mike Cole",
							"about_us_guides_stacy"=>"Meet our Guides : Stacy",
							"about_us_our_boat"=>"Our Boat",
						 	"our_boat_trips"=>"Our Boat Trips",
						 	"who_is_this_for"=>"Who is this for?",
						 	"individuals_couples_friends"=>"Individuals, couples and friends",
						 	"families"=>"Families",
						 	"stag_and_hen"=>"Stag and hen group",
						 	"corporate_groups"=>" Corporate Groups",
							"corporate_entertaining"=>"Corporate Entertaining",
						 	"how_book"=>"How to book",
						 	"blog"=>"Blog",
						 	"media_center"=>"Media Centre",
						 	"press_office"=>"Press Office",
						 	"press_release"=>"Press Releases",
						 	"in_the_news"=>"In the News",
						 	"experience"=>"The Experience",
						 	"safety"=>"Safety First",
                         	"vessels"=>"Vessels",
							"about_us_videos"=>"Videos",
						 	"links"=>"Links"
                        );


define ("PRICE_FEE", 3.95);

// nr de afisari pe pag :
define("PER_PAGE",25);

// date companie :
define("COMPANY_NAME","London Rib Voyages");
define("COMPANY_EMAIL","bookings@londonribvoyages.com");
define("COMPANY_EMAIL_FROM_BOOKINGS","bookings@londonribvoyages.com");
define("COMPANY_EMAIL_FROM","bookings@londonribvoyages.com");
define("COMPANY_EMAIL_CONFIRMATIONS","bookings@londonribvoyages.com");
//define("COMPANY_EMAIL_CONFIRMATIONS","fcisco@gmail.com");

//defines DEPARTURE
define("DEPARTURE_EDIT_OK","You have successfully edited the departure!");
define("DEPARTURE_EDIT_WRONG","ERROR! This departure was not edited.");
define("DEPARTURE_ADD_OK","You have successfully added a new departure!!");
define("DEPARTURE_ADD_WRONG","ERROR! This departure can't be added.");
define("DEPARTURE_DELETE_OK","You have successfully deleted the departure!");
define("DEPARTURE_DELETE_WRONG","ERROR! This departure can't be deleted.");
define("DEPARTURE_DELETE_EXIST","There is an order for this departure. I can't delete it!");

$COUNTRIES = array(
"AF"=>"AFGHANISTAN",
"AL"=>"ALBANIA",
"DZ"=>"ALGERIA",
"AS"=>"AMERICAN SAMOA",
"AD"=>"ANDORRA",
"AO"=>"ANGOLA",
"AI"=>"ANGUILLA",
"AQ"=>"ANTARCTICA",
"AG"=>"ANTIGUA AND BARBUDA",
"AR"=>"ARGENTINA",
"AM"=>"ARMENIA",
"AW"=>"ARUBA",
"AU"=>"AUSTRALIA",
"AT"=>"AUSTRIA",
"AZ"=>"AZERBAIJAN",
"BS"=>"BAHAMAS",
"BH"=>"BAHRAIN",
"BD"=>"BANGLADESH",
"BB"=>"BARBADOS",
"BY"=>"BELARUS",
"BE"=>"BELGIUM",
"BZ"=>"BELIZE",
"BJ"=>"BENIN",
"BM"=>"BERMUDA",
"BT"=>"BHUTAN",
"BO"=>"BOLIVIA",
"BA"=>"BOSNIA AND HERZEGOWINA",
"BW"=>"BOTSWANA",
"BV"=>"BOUVET ISLAND",
"BR"=>"BRAZIL",
"IO"=>"BRITISH INDIAN OCEAN TERRITORY",
"BN"=>"BRUNEI DARUSSALAM",
"BG"=>"BULGARIA",
"BF"=>"BURKINA FASO",
"BI"=>"BURUNDI",
"KH"=>"CAMBODIA",
"CM"=>"CAMEROON",
"CA"=>"CANADA",
"CV"=>"CAPE VERDE",
"KY"=>"CAYMAN ISLANDS",
"CF"=>"CENTRAL AFRICAN REPUBLIC",
"TD"=>"CHAD",
"CL"=>"CHILE",
"CN"=>"CHINA",
"CX"=>"CHRISTMAS ISLAND",
"CC"=>"COCOS (KEELING) ISLANDS",
"CO"=>"COLOMBIA",
"KM"=>"COMOROS",
"CN"=>"CONGO, Democratic Republic of (was Zaire)",
"CG"=>"CONGO, People's Republic of",
"CK"=>"COOK ISLANDS",
"CR"=>"COSTA RICA",
"CI"=>"COTE D'IVOIRE",
"HR"=>"CROATIA",
"CU"=>"CUBA",
"CY"=>"CYPRUS",
"CZ"=>"CZECH REPUBLIC",
"DK"=>"DENMARK",
"DJ"=>"DJIBOUTI",
"DM"=>"DOMINICA",
"DO"=>"DOMINICAN REPUBLIC",
"TL"=>"EAST TIMOR",
"EC"=>"ECUADOR",
"EG"=>"EGYPT",
"SV"=>"EL SALVADOR",
"GQ"=>"EQUATORIAL GUINEA",
"ER"=>"ERITREA",
"EE"=>"ESTONIA",
"ET"=>"ETHIOPIA",
"FK"=>"FALKLAND ISLANDS (MALVINAS)",
"FO"=>"FAROE ISLANDS",
"FJ"=>"FIJI",
"FI"=>"FINLAND",
"FR"=>"FRANCE",
"FX"=>"FRANCE, METROPOLITAN",
"GF"=>"FRENCH GUIANA",
"PF"=>"FRENCH POLYNESIA",
"TF"=>"FRENCH SOUTHERN TERRITORIES",
"GA"=>"GABON",
"GM"=>"GAMBIA",
"GE"=>"GEORGIA",
"DE"=>"GERMANY",
"GH"=>"GHANA",
"GI"=>"GIBRALTAR",
"GR"=>"GREECE",
"GL"=>"GREENLAND",
"GD"=>"GRENADA",
"GP"=>"GUADELOUPE",
"GU"=>"GUAM",
"GT"=>"GUATEMALA",
"GN"=>"GUINEA",
"GW"=>"GUINEA-BISSAU",
"GY"=>"GUYANA",
"HT"=>"HAITI",
"HM"=>"HEARD AND MC DONALD ISLANDS",
"HN"=>"HONDURAS",
"HK"=>"HONG KONG",
"HU"=>"HUNGARY",
"IS"=>"ICELAND",
"IN"=>"INDIA",
"ID"=>"INDONESIA",
"IR"=>"IRAN (ISLAMIC REPUBLIC OF)",
"IQ"=>"IRAQ",
"IE"=>"IRELAND",
"IL"=>"ISRAEL",
"IT"=>"ITALY",
"JM"=>"JAMAICA",
"JP"=>"JAPAN",
"JO"=>"JORDAN",
"KZ"=>"KAZAKHSTAN",
"KE"=>"KENYA",
"KI"=>"KIRIBATI",
"KP"=>"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF",
"KR"=>"KOREA, REPUBLIC OF",
"KW"=>"KUWAIT",
"KG"=>"KYRGYZSTAN",
"LA"=>"LAO PEOPLE'S DEMOCRATIC REPUBLIC",
"LV"=>"LATVIA",
"LB"=>"LEBANON",
"LS"=>"LESOTHO",
"LR"=>"LIBERIA",
"LY"=>"LIBYAN ARAB JAMAHIRIYA",
"LI"=>"LIECHTENSTEIN",
"LT"=>"LITHUANIA",
"LU"=>"LUXEMBOURG",
"MO"=>"MACAU",
"MK"=>"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF",
"MG"=>"MADAGASCAR",
"MW"=>"MALAWI",
"MY"=>"MALAYSIA",
"MV"=>"MALDIVES",
"ML"=>"MALI",
"MT"=>"MALTA",
"MH"=>"MARSHALL ISLANDS",
"MQ"=>"MARTINIQUE",
"MR"=>"MAURITANIA",
"MU"=>"MAURITIUS",
"YT"=>"MAYOTTE",
"MX"=>"MEXICO",
"FM"=>"MICRONESIA, FEDERATED STATES OF",
"MD"=>"MOLDOVA, REPUBLIC OF",
"MC"=>"MONACO",
"MN"=>"MONGOLIA",
"MS"=>"MONTSERRAT",
"MA"=>"MOROCCO",
"MZ"=>"MOZAMBIQUE",
"MM"=>"MYANMAR",
"NA"=>"NAMIBIA",
"NR"=>"NAURU",
"NP"=>"NEPAL",
"NL"=>"NETHERLANDS",
"AN"=>"NETHERLANDS ANTILLES",
"NC"=>"NEW CALEDONIA",
"NZ"=>"NEW ZEALAND",
"NI"=>"NICARAGUA",
"NE"=>"NIGER",
"NG"=>"NIGERIA",
"NU"=>"NIUE",
"NF"=>"NORFOLK ISLAND",
"MP"=>"NORTHERN MARIANA ISLANDS",
"NO"=>"NORWAY",
"OM"=>"OMAN",
"PK"=>"PAKISTAN",
"PW"=>"PALAU",
"PS"=>"PALESTINIAN TERRITORY, Occupied",
"PA"=>"PANAMA",
"PG"=>"PAPUA NEW GUINEA",
"PY"=>"PARAGUAY",
"PE"=>"PERU",
"PH"=>"PHILIPPINES",
"PN"=>"PITCAIRN",
"PL"=>"POLAND",
"PT"=>"PORTUGAL",
"PR"=>"PUERTO RICO",
"QA"=>"QATAR",
"RE"=>"REUNION",
"RO"=>"ROMANIA",
"RU"=>"RUSSIAN FEDERATION",
"RW"=>"RWANDA",
"KN"=>"SAINT KITTS AND NEVIS",
"LC"=>"SAINT LUCIA",
"VC"=>"SAINT VINCENT AND THE GRENADINES",
"WS"=>"SAMOA",
"SM"=>"SAN MARINO",
"ST"=>"SAO TOME AND PRINCIPE",
"SA"=>"SAUDI ARABIA",
"SN"=>"SENEGAL",
"SC"=>"SEYCHELLES",
"SL"=>"SIERRA LEONE",
"SG"=>"SINGAPORE",
"SK"=>"SLOVAKIA (Slovak Republic)",
"SI"=>"SLOVENIA",
"SB"=>"SOLOMON ISLANDS",
"SO"=>"SOMALIA",
"ZA"=>"SOUTH AFRICA",
"GS"=>"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS",
"ES"=>"SPAIN",
"LK"=>"SRI LANKA",
"SH"=>"ST. HELENA",
"PM"=>"ST. PIERRE AND MIQUELON",
"SD"=>"SUDAN",
"SR"=>"SURINAME",
"SJ"=>"SVALBARD AND JAN MAYEN ISLANDS",
"SZ"=>"SWAZILAND",
"SE"=>"SWEDEN",
"CH"=>"SWITZERLAND",
"SY"=>"SYRIAN ARAB REPUBLIC",
"TW"=>"TAIWAN",
"TJ"=>"TAJIKISTAN",
"TZ"=>"TANZANIA, UNITED REPUBLIC OF",
"TH"=>"THAILAND",
"TG"=>"TOGO",
"TK"=>"TOKELAU",
"TO"=>"TONGA",
"TT"=>"TRINIDAD AND TOBAGO",
"TN"=>"TUNISIA",
"TR"=>"TURKEY",
"TM"=>"TURKMENISTAN",
"TC"=>"TURKS AND CAICOS ISLANDS",
"TV"=>"TUVALU",
"UG"=>"UGANDA",
"UA"=>"UKRAINE",
"AE"=>"UNITED ARAB EMIRATES",
"GB"=>"UNITED KINGDOM",
"US"=>"UNITED STATES",
"UM"=>"UNITED STATES MINOR OUTLYING ISLANDS",
"UY"=>"URUGUAY",
"UZ"=>"UZBEKISTAN",
"VU"=>"VANUATU",
"VA"=>"VATICAN CITY STATE (HOLY SEE)",
"VE"=>"VENEZUELA",
"VN"=>"VIET NAM",
"VG"=>"VIRGIN ISLANDS (BRITISH)",
"VI"=>"VIRGIN ISLANDS (U.S.)",
"WF"=>"WALLIS AND FUTUNA ISLANDS",
"EH"=>"WESTERN SAHARA",
"YE"=>"YEMEN",
"YU"=>"YUGOSLAVIA",
"ZM"=>"ZAMBIA",
"ZW"=>"ZIMBABWE");

function get_reseller_name($I_order) {
    global $db;
	$query = "SELECT * FROM $db->resellers WHERE 1 AND reseller_del = 0";
	$resellers = $db->select_fields ($db->resellers, $query);
	$reseller = $I_order['order_reseller_id'] == '-1' ? 'LRV' : 'none';
	foreach ($resellers as $res) {
	    if ($res['reseller_id'] == $I_order['order_reseller_id']) {
	        $reseller = $res['reseller_name'];
	        break;
	    }
	}

	return $reseller;
}
