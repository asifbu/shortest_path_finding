<?php 
/**
 * Calculates the great-circle distance between two points, with
 * the Haversine formula.
 * @param float $latitudeFrom Latitude of start point in [deg decimal]
 * @param float $longitudeFrom Longitude of start point in [deg decimal]
 * @param float $latitudeTo Latitude of target point in [deg decimal]
 * @param float $longitudeTo Longitude of target point in [deg decimal]
 * @param float $earthRadius Mean earth radius in [m]
 * @return float Distance between points in [m] (same as earthRadius)
 */

class measure_distance {
function haversineGreatCircleDistance(
  $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
{
  // convert from degrees to radians
  $latFrom = deg2rad($latitudeFrom);
  $lonFrom = deg2rad($longitudeFrom);
  $latTo = deg2rad($latitudeTo);
  $lonTo = deg2rad($longitudeTo);

  $latDelta = $latTo - $latFrom;
  $lonDelta = $lonTo - $lonFrom;

  $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
    cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
  return $angle * $earthRadius;
}

// function distanceGeoPoints ($lat1, $lng1, $lat2, $lng2) {

//     $earthRadius = 3958.75;

//     $dLat = deg2rad($lat2-$lat1);
//     $dLng = deg2rad($lng2-$lng1);


//     $a = sin($dLat/2) * sin($dLat/2) +
//        cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
//        sin($dLng/2) * sin($dLng/2);
//     $c = 2 * atan2(sqrt($a), sqrt(1-$a));
//     $dist = $earthRadius * $c;

//     // from miles
//     $meterConversion = 1609.34;
//     $geopointDistance = $dist * $meterConversion;

//     return $geopointDistance;
// }

}

?>