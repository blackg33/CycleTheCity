<?php
?>
<head>
    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
    <header id="head">
        <img id="logo" alt="Cycle The City Logo" src="BIKE3.png"/>
        <div id="location_search">
            <label id="search"> Find a bike: </label>
            <input id="searchBox" type="text" placeholder="Enter your location "/>
        </div>
        <nav>
            
        </nav>
    </header>
        <div id="googleMap"></div>
</body>
<script>
    $(document).ready(function(){

    function initialize() {

    //GRAB MAP DIV BY ID & SET OPTIONS FOR MAP STARTING POINT/TYPE
    var mapCanvas = document.getElementById('googleMap');
    var myLatlng = new google.maps.LatLng(43.653528, -79.426732);

    var options = {
      center:myLatlng,
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    //CREATE NEW MAP OBJECT
    var map =new google.maps.Map(mapCanvas, options);

    //CREATE NEW SEARCH BOX OBJECT FOR LOCATION SEARCH
    var searchBox = new google.maps.places.SearchBox(document.getElementById('searchBox'));
    //EVENT LISTENER FOR SEARCH BOX
    google.maps.event.addListener(searchBox, 'places_changed',function(){

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
      /*
      function generateMarkers(yourLocations) {
          for (var i = 0; i < yourLocations.length; i++) {
            var coords = yourLocations[i].split(", ");
            new google.maps.Marker({
              position: new google.maps.LatLng(coords[0], coords[1]),
              map: map,
              title: yourLocations[i]
            });
          }
        }
        generateMarkers(yourLocations);*/
    }

    google.maps.event.addDomListener(window, 'load', initialize);

    marker.setMap(map);

    });

</script>
<script type="text/javascript" src="jquery-1.11.1.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

  
