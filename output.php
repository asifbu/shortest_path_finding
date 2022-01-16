<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
        <meta charset="utf-8">
        <title>Add a line to a map using a GeoJSON source</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
        <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet">
        <script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
        <style>
        body { margin: 0; padding: 0; }
        #take_value {float: left; position: absolute;width: 200px; height: 500px;color: red;}
        #maap {float: left; position: absolute;  width: 1200px; height: 500px;}
        h1{color: blue;}


        .left
         {
         float: left;
         width: 20%;
         height: 400px;
         }
         .right
         {
         float: left;
         width: 70%;
         height: 400px;
         }
         div{
         padding : 1%;
         color: white;
         /* background-color: 009900; */
         
         /* border: solid black; */
         }
</style>
    </head>
    <body>
   


<?php
require_once 'RunTest.php';

$raw = [
    ["a", "b", 2,-122.483696, 37.833818],
    ["b", "c", 4,-122.483482, 37.833174],
    ["c", "d", 3,-122.493782, 37.833683]
];
$main_value = [
    ["a", "b", 2,-122.483696, 37.833818],
    ["a", "d", 5,-122.483696, 37.833818],
    ["a", "c", 1,-122.483696, 37.833818],
    ["b", "c", 4,-122.483482, 37.833174],
    ["c", "d", 3,-122.493782, 37.833683]
];
$items=[];
$count = 0;
foreach($main_value as $i => $username) { 
 $items[$count++] = [$username[0],$username[1],$username[2]]; 
} 


$out = new run($items,"a","b");
$p = $out->runTest();
//print_r ($p);


$latlon=[];
$inc = 0;
// foreach($main_value as $j => $lat) { 
//  $latlon[$inc++] = [$lat[3],$lat[4]]; 
// } 

foreach($p as $value){?>
<?php 
foreach($raw as $j => $lat)
{
   if( $value == $lat[0])
   {
    $latlon[$inc++] = [$lat[3],$lat[4]]; 
   }


?>
    
    <!-- <h1><?php echo $value; ?> </h1> -->

<?php }}

//  $ph =  [
//     [-122.483696, 37.833818],
//     [-122.483482, 37.833174],
    // [-122.483396, 37.8327],
    // [-122.483568, 37.832056],
    // [-122.48404, 37.831141],
    // [-122.48404, 37.830497],
    // [-122.483482, 37.82992],
    // [-122.483568, 37.829548],
    // [-122.48507, 37.829446],
    // [-122.4861, 37.828802],
    // [-122.486958, 37.82931],
    // [-122.487001, 37.830802],
    // [-122.487516, 37.831683],
    // [-122.488031, 37.832158],
    // [-122.488889, 37.832971],
    // [-122.489876, 37.832632],
    // [-122.490434, 37.832937],
    // [-122.49125, 37.832429],
    // [-122.491636, 37.832564],
    // [-122.492237, 37.833378],
    // [-122.493782, 37.833683]
// ]
?>
  <h1><?php var_dump($latlon); ?> </h1>
     <div  class="left"> div tag   </div>
      <div id= "map" class="right"> div tag   </div>
<!-- <div id="take_value" >hello</div>
<div id="map" ></div> -->
<script>

var passedArray = 
    <?php echo json_encode($latlon); ?>;
    
	// TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	mapboxgl.accessToken = 'pk.eyJ1IjoiYXNpYnVsMzgiLCJhIjoiY2t4cmNrYXI0MGRrZDJvcGNqYnV1ZHNuZCJ9.F4yxVRLMvFdv1L0vYh7c4Q';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-122.486052, 37.830348],
        zoom: 15
    });

    map.on('load', () => {
        map.addSource('route', {
            'type': 'geojson',
            'data': {
                'type': 'Feature',
                'properties': {},
                'geometry': {
                    'type': 'LineString',
                    'coordinates': passedArray
                }
            }
        });
        map.addLayer({
            'id': 'route',
            'type': 'line',
            'source': 'route',
            'layout': {
                'line-join': 'round',
                'line-cap': 'round'
            },
            'paint': {
                'line-color': '#87ceeb',
                'line-width': 8
            }
        });
    });

</script>


</body>
</html>