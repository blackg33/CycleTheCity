$(document).ready(function(){

function initialize() {
    
//Grap map DIV by id    
var mapCanvas = document.getElementById('googleMap');
//set options for map starting point/type
var myLatlng = new google.maps.LatLng(43.653528, -79.426732);

var options = {
  center:myLatlng,
  zoom: 13,
  mapTypeId: google.maps.MapTypeId.ROADMAP
};

var map =new google.maps.Map(mapCanvas, options);
    
var marker = new google.maps.Marker({
    position: myLatlng,
    map: map,
    title:"Hello World!"
});

var searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));

google.maps.event.addListener(searchBox, 'places_changed',function(){
    //console.log(searchBox.getPlaces());
    var places = searchBox.getPlaces();
    var bounds = new google.maps.LatLngBounds();
    var i, place;
    
    for(i=0;place=places[i];i++){
        console.log(place.geometry.location);
        bounds.extend(place.geometry.location);
        marker.setPosition(place.geometry.location);
    }
    
    map.fitBounds(bounds);
    map.setZoom(13); //SET ZOOM FOR NEW LOCATIONS
});
//BIAS SEARCH RESULTS BASED ON WHATS IN CURRENT BOUNDS
google.maps.event.addListener(map, 'bounds_changed', function() {
    var bounds = map.getBounds();
    searchBox.setBounds(bounds);
  });
}

google.maps.event.addDomListener(window, 'load', initialize);

marker.setMap(map);

});