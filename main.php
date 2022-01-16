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
            $filedata = file_get_contents('path_relation.json');
            $path_relation = json_decode($filedata, true);

            $node_details = file_get_contents('raw.json');
            $main_node_data = json_decode($node_details, true);

            // <?php
            // Defining variables
    $source = $destination = "";
    // Checking for a POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $source = $_POST["source"];
    $destination = $_POST["destination"];}
  
    // } ?>


    ?>

    <div class="left">  
            <form method="POST" action="<?php ($_SERVER["PHP_SELF"]);?>">
            
                <select name="source">
                    <option value="">Source</option>
                    <?php foreach($main_node_data as $key => $value) {?>
                    <option value="<?php echo $key ?>">  <?php echo $value['name']; ?></option>
                    <?php }?>
                </select>
                <br>
                <br>

                <select name="destination" >
                    <option value="">Source</option>
                    <?php foreach($main_node_data as $key => $value) {?>
                    <option value="<?php echo $key ?>">  <?php echo $value['name']; ?></option>
                    <?php }?>
                </select>
                <br><br>
                <input type="submit" value="submit">
            </form> 

    <h1>  <?php  echo $destination; echo $source; ?> </h1>
        </div>
        <div id= "map" class="right">  </div>
   
<?php
require_once 'RunTest.php';


// $filedata = file_get_contents('path_relation.json');
// $path_relation = json_decode($filedata, true);

// $node_details = file_get_contents('raw.json');
// $main_node_data = json_decode($node_details, true);



$items=[];
$count = 0;
foreach($path_relation as $i => $node) { 
 $items[$count++] = [$node['node'],$node['relation_with'],$node['weight']]; 
} 


// $s_path = new run($items,"a","c");
$s_path = new run($items,$source,$destination);
$shortest_path = $s_path->runTest();



print_r ($shortest_path);
//echo $destination; echo $source; 



$latlon=[];
$inc = 0;

foreach($shortest_path as $shortest_path_node){?>
<?php 
    foreach($main_node_data as $main_node => $details_of_node)
    {
        if( $shortest_path_node == $main_node)
        {
            $latlon[$inc++] = [$details_of_node['lat'],$details_of_node['long']]; 
        }
    }
}
?>
       <!-- </br> <h4><?php var_dump($latlon); ?> </h4>
        -->

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