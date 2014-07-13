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
    zoom: 18,
    center: new google.maps.LatLng(start.lat, start.lng),
    zoomControl: false,
    scrollwheel: false
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
loadJSONfile(map,"./maps/toilet.json","toilet"); 
loadJSONfile(map,"./maps/ferry.json","ferry");   
loadJSONfile(map,"./maps/bus.json","bus");   
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
    url: './maps/images/ferry.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
  
  var imageTrain = {
    url: './maps/images/train.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
    var imageBus = {
    url: './maps/images/bus.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
    var imageDiscount = {
    url: './maps/images/discount.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
      var imageGoldgo = {
    url: './maps/images/goldgo.png',
    size: new google.maps.Size(32, 32),
    origin: new google.maps.Point(0,0),
    anchor: new google.maps.Point(0, 32)
  };
        var imageToilet = {
    url: './maps/images/toilet.png',
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
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: placeType,
        shape: shape,
        title: locations.name,
        zIndex: 5
    });
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

var centreMap = function(place) {
  var pos = getLocationXML(place);
  map.setCenter(new google.maps.LatLng(pos.lat, pos.lng));
}

google.maps.event.addDomListener(window, 'load', initialize);
