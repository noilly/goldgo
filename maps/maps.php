<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Complex icons</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAFs7b-BTdRvR3jlBEbvSuxvu3gOtZLsU8"></script>
    <script>


function getLocationXML(loc) {
    var loc1 = "https://maps.googleapis.com/maps/api/geocode/xml?address="
    var loc2 = loc.replace(/ /g, "_");
    //var loc3 = "&key=AIzaSyAFs7b-BTdRvR3jlBEbvSuxvu3gOtZLsU8";
	var loc3 = "&key=AIzaSyCC5tqTlGcJEXr2Gkrwl4Eal77fFzfmKR0";
    var loc4 = loc1 + loc2 + loc3;
	console.log(loc4);
    var xmlHttp = null;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", loc4, false);
    xmlHttp.send(null);
    xmlDoc = loadXMLString(xmlHttp.responseText);
	if(xmlDoc.getElementsByTagName("status")[0].innerHTML != "ZERO_RESULTS")
	{
    var location = {
		name: loc2,
        lat: Number(xmlDoc.getElementsByTagName("lat")[0].innerHTML),
        lng: Number(xmlDoc.getElementsByTagName("lng")[0].innerHTML)
    };	
    console.log(location);
    return location;
	}
	return false;
}

function loadXMLString(txt) {
    if (window.DOMParser) {
        parser = new DOMParser();
        xmlDoc = parser.parseFromString(txt, "text/xml");
    } else // code for IE
    {
        xmlDoc = new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async = false;
        xmlDoc.loadXML(txt);
    }
    return xmlDoc;
}
function loadJSONfile(map,file,type) 
{
var request = new XMLHttpRequest();
   request.open("GET",file , false);
   request.send(null)
   var items = JSON.parse(request.responseText);
for (var index = 0; index < items.length; ++index) 
{
          var item = {
		name: items[index]["name"],
        lat: items[index]["lat"],
        lng: items[index]["lng"]};
			setMarkers(item,type);		
	}
 }
 
 

function initialize() {

var start = getLocationXML("QUT Gardens Point Brisbane");
  var mapOptions = {
    zoom: 15,
    center: new google.maps.LatLng(start.lat, start.lng),
  }

map = new google.maps.Map(document.getElementById('map-canvas'),
                                mapOptions);
								
								//directionsDisplay.setMap(map);
								
								  var styles = [
  {
    stylers: [
      { hue: "#00ffe6" },
      { saturation: -20 }
    ]
  },{
    featureType: "road",
    elementType: "geometry",
    stylers: [
      { lightness: 100 },
      { visibility: "simplified" }
    ]
  },{
    featureType: "road",
    elementType: "labels",
    stylers: [
      { visibility: "off" }
    ]
  }
];

map.setOptions({styles: styles});
setMarkersByName("QUT Gardens Point Brisbane", "goldgo");
loadJSONfile(map,"toiletdata.json","toilet"); 
loadJSONfile(map,"ferry.json","ferry");   
loadJSONfile(map,"bus.json","bus");   
}
  var map;
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();

  
  

  function setMarkersByName( place, placeType)
  {
  var places = getLocationXML(place);
  if(places != false)
  setMarkers(places, placeType);
  }
function setMarkers( locations, placeType) {

  var imageFerry = {
    url: 'images/ferry.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
  
  var imageTrain = {
    url: 'images/train.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
    var imageBus = {
    url: 'images/bus.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
    var imageDiscount = {
    url: 'images/discount.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
      var imageGoldgo = {
    url: 'images/goldgo.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
        var imageToilet = {
    url: 'images/toilet.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
  
  var shape = {
      coords: [1, 1, 1, 20, 18, 20, 18 , 1],
      type: 'poly'
  };
  
	if(placeType == "train")
	{ placeType = imageTrain	}
	else if (placeType == "discount")
	{ placeType = imageDiscount}
	else if (placeType == "bus")
	{ placeType = imageBus}
	else if (placeType == "toilet")
	{ placeType = imageToilet}
	else if (placeType == "goldgo")
	{ placeType = imageGoldgo}
	else if (placeType == "ferry")
	{ placeType = imageFerry }
	
    var myLatLng = new google.maps.LatLng(locations.lat, locations.lng);
	//console.log(myLatLng);
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: placeType,
        shape: shape,
        title: locations.name,
        zIndex: 5
    });
	console.log(marker);
}
function calcRoute(fromPlace,toPlace) {
var from = new google.maps.LatLng(fromPlace.lng, fromPlace.lat);
var to = new google.maps.LatLng(toPlace.lng,toPlace.lat);
  var request = {
      origin: from,
      destination: to,
      // Note that Javascript allows us to access the constant
      // using square brackets and a string value as its
      // "property."
      travelMode: google.maps.TravelMode["TRANSIT"]
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
  </head>
  <body>
		    <div id="map-canvas"></div>
  </body>
</html>