<?php

$imageQueryS = explode(' ', "hello goodbye", 4);
$imageQuery = $imageQueryS[0].'+'.$imageQueryS[1].'+'.$imageQueryS[2];
echo $imageQuery;

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
    $title             = (string) $item->title;
    $location          = (string) $item->OLDlocation;
    $formatteddatetime = (string) $item->formatteddatetime;
    $OLDdescription    = (string) $item->OLDdescription;    
    $cost     = (string) $item->customfield[1];
    $bookings = (string) $item->customfield[2];
    $title    = str_replace(chr(174), '', $title);
    $title    = str_replace(chr(194), '', $title);
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
	$json = $json. '"},';
	if($diff + 2 == 7)
	{
	break;
	}
}
$json = substr($json , 0, -1);
$json = $json. ']';
echo $json;

?>