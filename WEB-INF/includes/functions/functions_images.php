<?
//------------------------------------------------------------------------------------
function make_voucher_images($uniq_id, $voucher_details) {

	$font=$_SERVER['DOCUMENT_ROOT']."/WEB-INF/assets/fonts/timesbi.ttf";
	$fontsize="34";
	$spacing = 1;
	$params = array("linespacing" => $spacing);
	if (($voucher_details['guests'] -1) == 0)
		$text = $voucher_details['voucher_order_to'];
	elseif (($voucher_details['guests'] -1) == 1)
		$text = $voucher_details['voucher_order_to']." and 1 Guest";
	else 
		$text = $voucher_details['voucher_order_to']." and ".($voucher_details['guests'] -1)." Guests";
	$size = Imageftbbox($fontsize, 0, $font, $text, $params);
	$dx = max($size[2], $size[4]) - min($size[0], $size[6]); // extreme x values
	$dy = (max($size[1], $size[3]) - min($size[5], $size[7]))*$spacing; // extreme y values
	$im = imagecreate ($dx+2, $dy+2);
	$textcolor = ImageColorAllocate($im, 0,0,0);
	$bgcolor = imagecolorallocate ($im, 255,255,255);
	imageFill($im, 0, 0, $bgcolor);
	imagefttext($im, $fontsize, 0, 0, -min($size[5], $size[7]),  $textcolor, $font, $text, $params);
	Imagejpeg($im, $_SERVER['DOCUMENT_ROOT']."/vouchers/names/".$uniq_id.".jpg");
	ImageDestroy($im);

	$font=$_SERVER['DOCUMENT_ROOT']."/WEB-INF/assets/fonts/arial.ttf";
	$fontsize="10";
	$spacing = 1;
	$params = array("linespacing" => $spacing);
	$text = "Voucher No.:".$voucher_details['voucher_order_number'];
	$size = Imageftbbox($fontsize, 0, $font, $text, $params);
	$dx = max($size[2], $size[4]) - min($size[0], $size[6]); // extreme x values
	$dy = (max($size[1], $size[3]) - min($size[5], $size[7]))*$spacing; // extreme y values
	$im = imagecreate ($dx+20, $dy+2);
	$textcolor = ImageColorAllocate($im, 76,76,76);
	$bgcolor = imagecolorallocate ($im, 255,255,255);
	imageFill($im, 0, 0, $bgcolor);
	imagefttext($im, $fontsize, 0, 0, -min($size[5], $size[7]),  $textcolor, $font, $text, $params);
	Imagejpeg($im, $_SERVER['DOCUMENT_ROOT']."/vouchers/numbers/".$uniq_id.".jpg");
	ImageDestroy($im);

	$font=$_SERVER['DOCUMENT_ROOT']."/WEB-INF/assets/fonts/timesi.ttf";
	$fontsize="15";
	$spacing = 1;
	$params = array("linespacing" => $spacing);
	$text = $voucher_details['voucher_order_date'];
	$size = Imageftbbox($fontsize, 0, $font, $text, $params);
	//$dx = max($size[2], $size[4]) - min($size[0], $size[6]); // extreme x values
	//$dy = (max($size[1], $size[3]) - min($size[5], $size[7]))*$spacing; // extreme y values
	$im = imagecreate (117, 43);
	$textcolor = ImageColorAllocate($im, 0,0,0);
	$bgcolor = imagecolorallocate ($im, 255,255,255);
	imageFill($im, 0, 0, $bgcolor);
	imagefttext($im, $fontsize, 0, 38, 38,  $textcolor, $font, $text, $params);
	Imagejpeg($im, $_SERVER['DOCUMENT_ROOT']."/vouchers/dates/".$uniq_id.".jpg");
	ImageDestroy($im);

}
//------------------------------------------------------------------------------------

?>