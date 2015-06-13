<?
// clasa care realizeaza procesarea imagnilor
// x3_image CLASS - START ---------------------------------------------------------------------------
// --------------------------------------------------------------------------------------------------
class x3_image {

var $image = FALSE;			// imaginea de prelucrat
var $ext = "jpg";			// extensia imaginii
var $mime = "image/jpeg";	// mime type-ul imaginii


// LOAD_IMAGE:		incarcarea imaginii care se doreste a fi prelucrata (functie de tipul imaginii)
// Parametrii: 		$path - calea imaginii ptr care se fac prelucrarile
// Returneaza:		TRUE, FALSE
// Uz: 				pentru orice prelucrare a unei imagini
// --------------------------------------------------------------------------------------------------
function load_image($path) {
	// se distruge imaginea veche, daca exista :
	if($this->image) {
		imagedestroy($this->image);
	}

	// se verifica tipul imagnii :
	$image_type = getimagesize($path);
	$this->mime = $image_type['mime'];
	
	// se construieste imaginea functie de tip :
	if($image_type[2]==2) {
		$this->ext = "jpg";
		if(!($this->image = imageCreateFromJpeg($path))) {
			return FALSE;
		} else {
			return TRUE;
		}
	} elseif($image_type[2]==1) {
		$this->ext = "gif";
		if(!($this->image = imageCreateFromGif($path))) {
			return FALSE;
		} else {
			return TRUE;
		}
	} elseif($image_type[2]==3) {
		$this->ext = "png";
		if(!($this->image = imageCreateFromPng($path))) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
}
// --------------------------------------------------------------------------------------------------


// SAVE_IMAGE:		salvarea imaginii incarcate cu load_image, la destinatia dorita
// Parametrii: 		$path - calea imaginii unde se salveaza imaginea
// 					$quality - calitatea imaginii (implicit = 75)
// Returneaza:		TRUE, FALSE
// Uz: 				uneori
function save_image($path, $quality=75) {
	if(!$this->image) {
		return FALSE;
	}
	$fp = fopen($path, "w");
	if(!$fp) {
		return FALSE;
	} else {
		fclose($fp);
		
		if($this->ext=="jpg") {
			if(!imageJpeg($this->image, $path, $quality)) {
				return FALSE;
			} else {
				return TRUE;
			}
		} elseif($this->ext=="gif") {
			if(!imageGif($this->image, $path, $quality)) {
				return FALSE;
			} else {
				return TRUE;
			}
		} elseif($this->ext=="png") {
			$pngQuality = ($quality - 100) / 11.111111;
			$pngQuality = round(abs($pngQuality));
			if(!imagePng($this->image, $path, $pngQuality)) {
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}
}
// --------------------------------------------------------------------------------------------------


// CLEAR_IMAGE:		stergerea imaginii incarcate cu load_image
// Parametrii: 		
// Returneaza:		TRUE, FALSE
// Uz: 				rar
// --------------------------------------------------------------------------------------------------
function clear_image() {
	if($this->image) {
		imagedestroy($this->image);
		$this->image = FALSE;
		return TRUE;
	} else {
		return TRUE;
	}
}
// --------------------------------------------------------------------------------------------------


// GET_WIDTH:		ia latimea imaginii incarcate cu load_image
// Parametrii: 		
// Returneaza:		latimea imaginii
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function get_width() {
	if(!$this->image) {
		return 0;
	}
	return imageSX($this->image);
}
// --------------------------------------------------------------------------------------------------


// GET_HEIGHT:		ia inaltimea imaginii incarcate cu load_image
// Parametrii: 		
// Returneaza:		inaltimea imaginii
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function get_height() {
	if(!$this->image) {
		return 0;
	}
	return imageSY($this->image);
}
// --------------------------------------------------------------------------------------------------


// resizeW:			redimensioneaza imaginea incarcata cu load_image, cu constrangere la latime
// Parametrii: 		$newWidth - latimea de redimensionare
// Returneaza:		TRUE, FALSE
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function resizeW($newWidth) {
	if(!$this->image) {
		return FALSE;
	}
	$oldWidth = imageSX($this->image);
	$oldHeight = imageSY($this->image);
	$newHeight = ($oldHeight / ($oldWidth / $newWidth));
	
	$imageNew = ImageCreateTrueColor($newWidth, $newHeight);
	// preserve transparency
	if($this->ext == "gif" or $this->ext == "png"){
		imagecolortransparent($imageNew, imagecolorallocatealpha($imageNew, 0, 0, 0, 127));
		imagealphablending($imageNew, false);
		imagesavealpha($imageNew, true);
	}    
	imagecopyresampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	imageDestroy($this->image);
	$this->image = $imageNew;
	return TRUE;
}
// --------------------------------------------------------------------------------------------------


// resizeH:			redimensioneaza imaginea incarcata cu load_image, cu constrangere la inaltime
// Parametrii: 		$newHeight - inaltimea de redimensionare
// Returneaza:		TRUE, FALSE
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function resizeH($newHeight) {
	if(!$this->image) {
		return FALSE;
	}
	$oldWidth = imageSX($this->image);
	$oldHeight = imageSY($this->image);
	$newWidth = ($oldWidth / ($oldHeight / $newHeight));
	
	$imageNew = ImageCreateTrueColor($newWidth, $newHeight);
	// preserve transparency
	if($this->ext == "gif" or $this->ext == "png"){
		imagecolortransparent($imageNew, imagecolorallocatealpha($imageNew, 0, 0, 0, 127));
		imagealphablending($imageNew, false);
		imagesavealpha($imageNew, true);
	}    
	imagecopyresampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	imageDestroy($this->image);
	$this->image = $imageNew;
	return TRUE;
}
// --------------------------------------------------------------------------------------------------


// resizeWH:		redimensioneaza imaginea incarcata cu load_image la dimensiunile dorite
// Parametrii: 		$maxWidth - latimea noua de redimensionare
// 					$maxHeight - inaltimea noua de redimensionare 
//					$stretch - este 1 sau TRUE, daca dimensionarea nu se face cu constrangere
// Returneaza:		TRUE, FALSE
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function resizeWH($maxWidth, $maxHeight, $stretch=FALSE) {
	if(!$this->image) {
		return FALSE;
	}
	$oldWidth = imageSX($this->image);
	$oldHeight = imageSY($this->image);
	$newWidth= $maxWidth;
	$newHeight= $maxHeight;        
	if(!$stretch) {
		$ratio = $oldWidth / $oldHeight;
		if(($maxWidth  / $maxHeight) < $ratio) {
			$newHeight = ($oldHeight / ($oldWidth / $maxWidth));
		} else {
			$newWidth = ($oldWidth / ($oldHeight / $maxHeight));
		}
	}
	
	$imageNew = ImageCreateTrueColor($newWidth, $newHeight);  
	// preserve transparency
	if($this->ext == "gif" or $this->ext == "png"){
		imagecolortransparent($imageNew, imagecolorallocatealpha($imageNew, 0, 0, 0, 127));
		imagealphablending($imageNew, false);
		imagesavealpha($imageNew, true);
	}
	imagecopyresampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	imageDestroy($this->image);
	$this->image = $imageNew;
	return TRUE;
}
// --------------------------------------------------------------------------------------------------


// resizeCropped:	redimensioneaza imaginea prin taiere la dimensiunile date
// Parametrii: 		$width - latimea de redimensionare cu taiere
// 					$inaltimea - inaltimea de redimensionare cu taiere
// Returneaza:		TRUE, FALSE
// Uz: 				la redimensionare
// --------------------------------------------------------------------------------------------------
function resizeCropped($width, $height) {
	if(!$this->image) {
		return FALSE;
	}
	$oldWidth = imageSX($this->image);
	$oldHeight = imageSY($this->image);
	
	$ratioW = $oldWidth / $width;
	$ratioH = $oldHeight / $height;
	if($ratioH > $ratioW) {
		// some parts from the height will have to be cut off
		$newWidth = $oldWidth;
		$newHeight = $height * $ratioW;
		$srcX = 0;
		$srcY = +($oldHeight - $newHeight) / 2;
	} else {
		// some parts from the width will have to be cut off
		$newWidth = $width * $ratioH;
		$newHeight = $oldHeight;
		$srcX = +($oldWidth - $newWidth) / 2;
		$srcY = 0;
	}
	$imageNew = ImageCreateTrueColor($newWidth, $newHeight);    
	// preserve transparency
	if($this->ext == "gif" or $this->ext == "png"){
		imagecolortransparent($imageNew, imagecolorallocatealpha($imageNew, 0, 0, 0, 127));
		imagealphablending($imageNew, false);
		imagesavealpha($imageNew, true);
	}
	imagecopyresampled($imageNew, $this->image, 0, 0, $srcX, $srcY, $oldWidth, $oldHeight, $oldWidth, $oldHeight);
	imageDestroy($this->image);
	$this->image = $imageNew;
	
	// Now we are actually going to resample the image to the correct size        
	$oldWidth = $newWidth;
	$oldHeight = $newHeight;
	$newWidth = $width;
	$newHeight = $height;
	
	$imageNew = ImageCreateTrueColor($newWidth, $newHeight);
	// preserve transparency
	if($this->ext == "gif" or $this->ext == "png"){
		imagecolortransparent($imageNew, imagecolorallocatealpha($imageNew, 0, 0, 0, 127));
		imagealphablending($imageNew, false);
		imagesavealpha($imageNew, true);
	}    
	imagecopyresampled($imageNew, $this->image, 0, 0, 0, 0, $newWidth, $newHeight, $oldWidth, $oldHeight);
	imageDestroy($this->image);
	$this->image = $imageNew;
	
	return TRUE;    
}
// --------------------------------------------------------------------------------------------------
}
// --------------------------------------------------------------------------------------------------
// x3_image CLASS - END --------------------------------------------------------------------------
?>