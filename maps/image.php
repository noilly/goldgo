<?php


$name = str_replace(' ', '+', $_GET["subject"]);
$xml = file_get_contents("http://api.trove.nla.gov.au/result?key=as1f5uj06ifi0e3j&zone=picture&q=flickr+" . $name. '&n=1');


function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return( substr($string,$ini,$len));
}

$filename = get_string_between($xml,'<identifier type="url" linktype="thumbnail">','</identifier>');
if(empty ($filename))
{
$xml = file_get_contents("http://api.trove.nla.gov.au/result?key=as1f5uj06ifi0e3j&zone=picture&q=flickr+old+men+women&n=1");
$filename = get_string_between($xml,'<identifier type="url" linktype="thumbnail">','</identifier>');
}

$filename = str_replace('_t.jpg', '.jpg', $filename);
$percent = 2;

// Content type
header('Content-Type: image/jpeg');

// Get new sizes
list($width, $height) = getimagesize($filename);
$newwidth = $width * $percent;
$newheight = $height * $percent;

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);
$source = imagecreatefromjpeg($filename);

// Resize
imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
$random =  rand (0,4);

if( $random  == 0)
{
imagefilter($thumb, IMG_FILTER_COLORIZE, 0, 0, 100);
}
if( $random  == 1)
{
imagefilter($thumb, IMG_FILTER_COLORIZE, 50, -50, 50);
}
if( $random  == 2)
{
imagefilter($thumb, IMG_FILTER_COLORIZE, 100, 100, -100);
}
if( $random  == 3)
{
imagefilter($thumb, IMG_FILTER_COLORIZE, 0, 100, 0);
}
if( $random  == 4)
{
imagefilter($thumb, IMG_FILTER_COLORIZE, 100, 0, 0);
}
imagefilter($thumb, IMG_FILTER_CONTRAST, -40);
imagefilter($thumb, IMG_FILTER_BRIGHTNESS, 50);
imagefilter($thumb, IMG_FILTER_GAUSSIAN_BLUR);
// Output
imagejpeg($thumb);
imagedestroy($thumb);


?>

