<?php
    require'JSON/bikeShare.php';
?>
<head>
    <link rel="stylesheet" type="text/css" href="CSS/style.css"/>
    <link href='http://fonts.googleapis.com/css?family=Raleway:500' rel='stylesheet' type='text/css'>
    <meta charset="UTF-8">
</head>
<body>
    <header id="head">
        <img id="logo" alt="Cycle The City Logo" src="images/BIKE3.png"/>
        <div id="location_search">
            <label id="search"> Find a bike station nearby: </label>
            <input id="searchBox" type="text" placeholder="Enter your location "/>
        </div>
        <div id="discover">
            <label>Discover: </label>
            <select id="filters">
                <option>Food Trucks</option>
                <option>Parks</option>
                <option>Restaurants</option>
            </select> 
        </div>
    </header>
        <div id="googleMap"></div>
</body>
<script type="text/javascript" src="script/jquery-1.11.1.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=places"></script>

<script>
    $(document).ready(function(){

    function initialize() {

    //GRAB MAP DIV BY ID & SET OPTIONS FOR MAP STARTING POINT/TYPE
    var mapCanvas = document.getElementById('googleMap');
    var myLatlng = new google.maps.LatLng(43.661368200000000000, -79.383094200000020000);
    //SET MAP OPTIONS
    var options = {
      center:myLatlng,
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    //CREATE NEW MAP OBJECT
    var map =new google.maps.Map(mapCanvas, options); 
    var marker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        title: 'You are here'
    });
/*--------------SEARCH BOX------------------*/
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
        map.setZoom(16); //SET ZOOM FOR NEW LOCATIONS
    });
    //BIAS SEARCH RESULTS BASED ON WHATS IN CURRENT BOUNDS
    google.maps.event.addListener(map, 'bounds_changed', function() {
        var bounds = map.getBounds();
        searchBox.setBounds(bounds);
      });
   /*--------------BIKE SHARE LOCATION MARKERS------------------*/   
      var bikeLocations = <?php echo json_encode($all_stations); ?>;
      
      function generateMarkers(bikeLocations) {
          for (var i = 0; i < bikeLocations.length; i++) {
            var coords = bikeLocations[i].split(",");
            new google.maps.Marker({
              position: new google.maps.LatLng(coords[0], coords[1]),
              map: map,
              icon: 'images/cycling.png',
              title: "Click for details"
            });
          }
        }
        generateMarkers(bikeLocations);
         
        var info_window = new google.maps.InfoWindow({
            content:"test"
        });
        google.maps.event.addListener(marker, 'click', function(){
            info_window.open(map,marker);
        });
        
    };//END INITIALIZE 

    google.maps.event.addDomListener(window, 'load', initialize);

    //marker.setMap(map);

    });

</script>


  
