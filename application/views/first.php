<?php

$man_coords_json = file_get_contents(__DIR__ . '/coords.json');

$man_coords = json_decode($man_coords_json, true);

$earth_radius = 6371;

$query = "";

$count = count($man_coords);

$average = $count / 23;

$i = 0;

foreach ($man_coords as $key => $man_coord) {
    if (($key + 1) % $average == 0) {
        $query .= "%7Cvia:" . $man_coord['lat'] . "%2C" . $man_coord['lng'];
        $i++;
    }
}

$first_coord = $man_coords[0];
$last_coord = end($man_coords);

$link = "https://maps.googleapis.com/maps/api/directions/json?origin=" . $first_coord['lat'] . ',' . $first_coord['lng'] . "&destination=" . $last_coord['lat'] . ',' . $last_coord['lng'] . '&mode=driving&key=AIzaSyDwcGALDxWC1T-5fnGvlzxvIJIoghO0ZUc&waypoints=' . substr($query, 3);

// Pass this via curl and get response

$driection_response_json = file_get_contents(__DIR__ . '/direction.json');

$direction_response = json_decode($driection_response_json, true);

$road_coords = [];
foreach ($direction_response['routes'] as $route) {
    foreach ($route['legs'] as $leg) {
        foreach ($leg['steps'] as $key => $step) {
            $road_coords[] = $step['start_location'];
        }
    }
}

function distance($lat1, $lon1, $lat2, $lon2, $unit=null)
{

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

$real_coordinates = [];

foreach ($man_coords as $man_key => $man_coord) {

    $minimum_distance_1_key = 0;
    $minimum_distance_2_key = 0;
    $minimum_distance_1 = 0;
    $minimum_distance_2 = 0;

    foreach ($road_coords as $road_key => $road_coord) {
        // Calculate distance with road_coord and man_coord
		$distance = distance($road_coord['lat'],$road_coord['lng'],$man_coord['lat'],$man_coord['lng']);
		
        if ($distance < $minimum_distance_2 || $road_key == 0) {

            $minimum_distance_1 = $minimum_distance_2;
            $minimum_distance_1_key = $minimum_distance_2_key;
            $minimum_distance_2 = $distance;
            $minimum_distance_2_key = $road_key;
        }
    }

    $minimum_distance_1_coord = $road_coords[$minimum_distance_1_key];
	$minimum_distance_2_coord = $road_coords[$minimum_distance_2_key];
	
	$p1 = $minimum_distance_1_coord;
	$p2 = $minimum_distance_2_coord;
	$p3 = $man_coord;

	$x1 = $earth_radius* cos(($p1['lat']*pi())/180) * cos(($p1['lng']*pi())/180);
	$y1 = $earth_radius * cos(($p1['lat']*pi())/180) * sin(($p1['lng']*pi())/180);
	$z1 = $earth_radius * sin(($p1['lat']*pi())/180);

	$x2 = $earth_radius* cos(($p2['lat']*pi())/180) * cos(($p2['lng']*pi())/180);
	$y2 = $earth_radius * cos(($p2['lat']*pi())/180) * sin(($p2['lng']*pi())/180);
	$z2 = $earth_radius * sin(($p2['lat']*pi())/180);

	$x3 = $earth_radius* cos(($p3['lat']*pi())/180) * cos(($p3['lng']*pi())/180);
	$y3 = $earth_radius * cos(($p3['lat']*pi())/180) * sin(($p3['lng']*pi())/180);
	$z3 = $earth_radius * sin(($p3['lat']*pi())/180);

	$x = (($x2-$x1)*($x3*($x2-$x1)+$y3*($y2-$y1)) + ($y2-$y1)*($x1*$y2-$x2*$y1))/(pow($x2-$x1,2)+pow($y2-$y1,2));
	$y = (($y2-$y1)*($x3*($x2-$x1)+$y3*($y2-$y1)) - ($x2-$x1)*($x1*$y2-$x2*$y1))/(pow($x2-$x1,2)+pow($y2-$y1,2));
	$z = (($z2-$z1)*($x3*($x2-$x1)+$z3*($z2-$z1)) - ($x2-$x1)*($x1*$z2-$x2*$z1))/(pow($x2-$x1,2)+pow($z2-$z1,2));

	$lat = asin($z3/$earth_radius);
	$lng = atan2($y,$x);
	if(!is_nan($lat)&&!is_nan($lng))
		$real_coordinates[] = ['lat'=>$lat*180/pi(),'lng'=>$lng*180/pi()];
}

var_dump(json_encode($real_coordinates));

