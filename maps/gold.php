<?php
$feedWeather  = file_get_contents('http://api.openweathermap.org/data/2.5/forecast/daily?q=brisbane,au&mode=json&units=metric&cnt=7');
$weather      = json_decode($feedWeather);
$weatherStack = array();

for ($i = 0; $i <= 6; $i++) {
    $object       = new stdClass();
    $object->max  = ($weather->{"list"}[$i]->{"temp"}->{"max"});
    $object->main = ($weather->{"list"}[$i]->{"weather"}[0]->{"main"});
    $object->desc = ($weather->{"list"}[$i]->{"weather"}[0]->{"description"});
    array_push($weatherStack, $object);
}
$feed = file_get_contents('http://www.trumba.com/calendars/gold.rss');
$feed = str_replace('x-trumba:', '', $feed);
$feed = str_replace('xCal:', 'OLD', $feed);

$rss = simplexml_load_string($feed);
$json = '[';
foreach ($rss->channel->item as $item) {
	$advice = "";
    $title             = (string) $item->title;
    $location          = (string) $item->OLDlocation;
    $formatteddatetime = (string) $item->formatteddatetime;
    $OLDdescription    = (string) $item->OLDdescription;    
    $cost     = (string) $item->customfield[1];
    $bookings = (string) $item->customfield[2];
    $title    = str_replace(chr(174), '', $title);
    $title    = str_replace(chr(194), '', $title);
	$pos = strpos($title, ' ', strpos($title, ' ')+1);
	$imageQuery = substr($title , 0, $pos);
	$imageQuery = str_replace(' ', '+', $imageQuery);
	$date = date_parse($formatteddatetime);    
    $dateTime = new dateTime($date["year"] . '-' . $date["month"] . '-' . $date["day"]);
    $today    = new dateTime(date("y-m-d"));
    $diff     = $dateTime->diff($today)->format("%a");
    $json = $json. '{"title":"';
	$json = $json. $title;
    $json = $json. '","location":"';
    $json = $json. $location;
	$json = $json. '","date":"';
    $json = $json. $formatteddatetime;
    $json = $json. '","description":"';
    $json = $json. $OLDdescription;
	$json = $json. '","cost":"';
    $json = $json. $cost;
	$json = $json. '","booking":"';
    $json = $json. $bookings;
    $json = $json. '","max":"';
    $json = $json. ($weatherStack[$diff + 1]->max);
	$json = $json. '","main":"';
    $json = $json. ($weatherStack[$diff + 1]->main);
	$json = $json. '","desc":"';
    $json = $json. ($weatherStack[$diff + 1]->desc);
	$json = $json. '","imgWeather":"';
	$json = $json. './image.php?subject=weather+'. str_replace(' ', '+', ($weatherStack[$diff + 1]->desc));	
	$json = $json. '","imgEvent":"';
	$json = $json. './image.php?subject=+'.$imageQuery;	
	if (strpos(($weatherStack[$diff + 1]->desc),'thunderstorms') !== false) 
	{
	$advice = $advice.'Looks like thunderstorms, be careful out there. Take a rain coat or bring an umbrella, and try to stay indoors. ';
	}
	elseif (strpos(($weatherStack[$diff + 1]->desc),'rain') !== false) 
	{
	$advice = $advice.'Looks like Rain. Be cautious of slippery surfaces. Take a rain coat or bring an umbrella, and try to stay indoors. ';
	}
	elseif (strpos(($weatherStack[$diff + 1]->desc),'snow') !== false) 
	{
	$advice = $advice.'Looks like Snow, be sure to wear lots of layers and pay attention to weather warnings. ';
	}
	elseif (strpos(($weatherStack[$diff + 1]->desc),'clear') !== false) 
	{
	$advice = $advice.'Clear skies, Take a sun hat and sunblock with you. ';
	}
	elseif (strpos(($weatherStack[$diff + 1]->desc),'cloud') !== false) 
	{
	$advice = $advice.'Looking cloudy, it might get dark early. ';
	}
	
	if (intval($weatherStack[$diff + 1]->max) > 20)
	{
		$advice = $advice.'Its not very warm today, wear plenty of layers. ';
	}
	else 
	{
		$advice = $advice.'Its going to be warm today, be conscious of the sun and drink plenty of water. ';
	}
	$json = $json. '","advice":"';
    $json = $json. $advice;	
	$json = $json. '"},';
	
	if($diff + 2 == 7)
	{
	break;
	}
}
$json = substr($json , 0, -1);
$json = $json. ']';
$json = str_replace(array("\r\n", "\r"), "\n", $json);

$json = str_replace(chr(10), "", $json);
$json = str_replace(chr(13), "", $json);

echo $json;

?>