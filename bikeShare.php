<?php

$url = 'http://www.bikesharetoronto.com/stations/json';

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json_data = curl_exec($curl);
curl_close($curl);
    
 $result = json_decode($json_data, true);
 
 $stations = $result['stationBeanList'];

foreach($result['stationBeanList']as $item){
    
    echo "<p>" . $item['stationName'] . "</p>";
}
