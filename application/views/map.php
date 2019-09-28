<!DOCTYPE html>
<html>

<head>
	<title>Simple Map</title>
	<meta name="viewport" content="initial-scale=1.0">
	<meta charset="utf-8">
	<style>
		/* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
		#map {
			height: 100%;
		}

		/* Optional: Makes the sample page fill the window. */
		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}
	</style>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDwcGALDxWC1T-5fnGvlzxvIJIoghO0ZUc&callback=initMap" defer async></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
	<div id="map"></div>
	<script>

		var map;
		function initMap() {
			// map = new google.maps.Map(document.getElementById('map'), {
			// 	center: { lat: 6.9143238, lng: 79.8774568 },
			// 	zoom: 15
			// });
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: {
						"lat":6.9143238,
						"lng":79.8774568
					},
				mapTypeId: 'terrain'
        	});
			

			$(document).ready(function () {
				$.ajax({
					method: 'get',
					url: '../assets/final.json',
					dataType: 'json',
					success: function (data) {
						var passedPath = new google.maps.Polyline({
							path: data,
							geodesic: true,
							strokeColor: '#0000BB',
							strokeOpacity: 1.0,
							strokeWeight: 2
						});

						passedPath.setMap(map);


						// console.log(data);
						// var set_gps = [];
						// var gps_lat_lng;
						// var set_gps = [
						// 	{lat:6.9143238, lng: 79.8774568},
						// 	{lat: 6.9137942, lng:79.87745796456936},
						// 	{lat: 6.913825, lng: 79.87745962055868},
						// 	{lat: 6.9136977, lng:79.87745686997104},
							

						// ];


						// var flightPlanCoordinates = [
						// 	{lat: 37.772, lng: -122.214},
						// 	{lat: 21.291, lng: -157.821},
						// 	{lat: -18.142, lng: 178.431},
						// 	{lat: -27.467, lng: 153.027}
						// ];


						// console.log(set_gps);
						// console.log(flightPlanCoordinates);
						// var flightPath = new google.maps.Polyline({
						// 	path: data,
						// 	geodesic: true,
						// 	strokeColor: '#FF0000',
						// 	strokeOpacity: 1.0,
						// 	strokeWeight: 2
						// });

						// flightPath.setMap(map);
					}
				})
			})
		}

	</script>
</body>

</html>