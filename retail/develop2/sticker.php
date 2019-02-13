<?php 
//Parameter
$charLimit=30;
$charSize=35;
$rotation=0;
$startFromX=210;		//y start from;
$startFromY=190;	//x start from;
$startIbuFromX=750;		//x ibu start from;
$startAlcoolFromX=175;//x alcool start from;
$startSizeFromX=475;	//x size start from;
$Y=1250;
$textY=150;
if (isset ($_GET['size']))
	$size=$_GET['size'];
else 
	$size=100;

//Set size for 1l sticker
if($size==100 ){
	$charLimit=30;
	$charSize=25;
	$rotation=0;
	$startFromY=210;		
	$startFromX=160;	
	$startIbuFromX=500;		
	$startAlcoolFromX=150;
	$startSizeFromX=350;
	$textY=150;
	$Y=850;
}
//Set size for 75cl sticker
if($size==75 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromX=210;
	$startFromY=190;
	$startIbuFromX=750;
	$startAlcoolFromX=200;
	$startSizeFromX=430;
	$Y=1250;	
}
//Set size for 50cl sticker
if($size==50 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromX=210;
	$startFromY=190;
	$startIbuFromX=750;
	$startAlcoolFromY=175;
	$startSizeFromX=430;
	$Y=1250;		
}

//Set size for 33cl sticker
if(isset($_GET['size'])&& ($_GET['size'])==33 ){
	$charLimit=30;
	$charSize=35;
	$rotation=0;
	$startFromX=210;
	$startFromY=190;
	$startIbuFromX=750;
	$startAlcoolFromX=175;
	$startSizeFromX=430;	
}
///////////////////////////


$root="C:/xampp/htdocs/beerecipe/retail/develop2";
$font=$root.'/fonts/arial.ttf';

// Create new image
$stickerImg = imagecreatefromjpeg($root.'/stickers/BlackSticker_'.$size.'.jpg');

// Define bg color and text 
$bgColor = imagecolorallocate($stickerImg,000,000,000);
$txtColor = imagecolorallocate($stickerImg,255,255,255);
// Put color on img
imagefill($stickerImg,0,0,$bgColor);

// Create variable with the text to print
if ( isset($_GET['uid']) ) {
	$uid = $_GET['uid'];
}
$mysqli = new mysqli("localhost", "root", "", "beerecipe");
$recipes = $mysqli->query("SELECT uid,name,description,category,amount,ibu,alcool FROM `recipe` WHERE uid =".$uid);
$recipe = $recipes->fetch_row();
$text = $recipe[2];
$ibu="IBU: ".intval($recipe[5]);
$alcool=intval($recipe[6])."% vol.";

//from Descripton make rows
$formattedText = wordwrap($text, $charLimit, "\n");

// Scrivo il testo all'interno dell'immagine
imagettftext($stickerImg, $charSize, $rotation, $startFromX, $textY, $txtColor, $font, $formattedText);
imagettftext($stickerImg, $charSize, $rotation, $startIbuFromX, $Y, $txtColor, $font, $ibu);
imagettftext($stickerImg, $charSize, $rotation, $startAlcoolFromX, $Y, $txtColor, $font, $alcool);
imagettftext($stickerImg, $charSize, $rotation, $startSizeFromX, $Y, $txtColor, $font, $size." cl");

// Definisco l'intestazione del file
// indicando che si tratta di una immagine Jpeg
header("Content-type: image/jpeg");

// Mostro l'immagine creata
imagejpeg($stickerImg);
?>
<div class="col-lg-12">
    <div class="panel panel-default">
    	<br/>
        <div class="panel-body">
        </div>
    </div>
</div>
    <!-- Custom JavaScript -->
    <script src="js/custom.js"></script>