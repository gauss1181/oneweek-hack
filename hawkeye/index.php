<!DOCTYPE html>
<html>
<head>
	<title>Hawkeye | TraffickTips</title>
	<script charset="UTF-8" type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1"></script>
	<style>
		body { margin: 0; font: 12pt/1.5 sans-serif; }
		#mapDiv { position: fixed; top: 50px; left: 0; bottom: 0; right: 0; }
		header { padding: 5px 15px; line-height: 40px; background: #CCC; font-size: 120%; color: #FFF; }
		h1 { margin: 0; text-indent: -999999px; background: url(/img/logo.png) left no-repeat; background-size: contain; }
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</script>
</head>
<body>
	<header>
		<h1>TrafficTips HawkEye</h1>
	</header>
	<div id='mapDiv'></div>
	<script type="text/javascript">
		(function () {
			var map;
			
			Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: themesModuleLoaded });
			function themesModuleLoaded() {
				Microsoft.Maps.loadModule('Microsoft.Maps.Overlays.Style', { callback: GetMap });
			}

			function shapesModuleLoaded() {
				var options = {
					fillColor: new Microsoft.Maps.Color(100, 255, 100, 0),
					strokeColor: new Microsoft.Maps.Color(50, 255, 100, 0),
					strokeThickness: 1
				};
				var vertices = [
					new Microsoft.Maps.Location(47.647670, -122.124146),
					new Microsoft.Maps.Location(47.646766, -122.125015),
					new Microsoft.Maps.Location(47.646802, -122.122794),
					new Microsoft.Maps.Location(47.647670, -122.124146)
				];
				var polygon = new Microsoft.Maps.Polygon(vertices, options);
         		map.entities.push(polygon);
				 
				vertices = [
					new Microsoft.Maps.Location(47.644027, -122.118588),
					new Microsoft.Maps.Location(47.641902, -122.118996),
					new Microsoft.Maps.Location(47.641526, -122.120219),
					new Microsoft.Maps.Location(47.644287, -122.120208),
					new Microsoft.Maps.Location(47.644027, -122.118588)
				];
				polygon = new Microsoft.Maps.Polygon(vertices, options);
         		map.entities.push(polygon);
			}

			function makeInfobox(pushpin, imgsrc) {
				var options = {
					htmlContent: '<img src="' + imgsrc + '" style=\"width: 50%;\" />',
					pushpin: pushpin
				};
				var infobox = new Microsoft.Maps.Infobox(pushpin.getLocation(), options);
         		map.entities.push(infobox);
				return infobox;
			}

			function insertPin(lat, long, imgsrc) {
				var location = new Microsoft.Maps.Location(lat, long);
				var pushpin = new Microsoft.Maps.Pushpin(location);
				if (imgsrc !== null) {
					var infobox = makeInfobox(pushpin, imgsrc);
					pushpin.setOptions({
						infobox: infobox
					});
				}
         		map.entities.push(pushpin);
			}

			function GetMap() {
				var options = {
					credentials:"Au_kHqNbZbddwJUaoPTz-tfjHTfZtuPYiBifygz7YU3Y8QpyERxo_Qs2tnitGcGn",
					center: new Microsoft.Maps.Location(47.642119, -122.127096),
                    mapTypeId: Microsoft.Maps.MapTypeId.road,
                    zoom: 15,
					customizeOverlays: true,
					theme: new Microsoft.Maps.Themes.BingTheme() 
				};
				map = new Microsoft.Maps.Map(document.getElementById("mapDiv"), options);
				Microsoft.Maps.loadModule('Microsoft.Maps.AdvancedShapes', { callback: shapesModuleLoaded });
<?php
	if (file_exists("../data/reports.csv") && ($handle = fopen("../data/reports.csv", "r")) !== FALSE) {
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
?>			
				insertPin(<?php echo $data[4]; ?>, <?php echo $data[5] === '' ? 'null' : ('"' . addslashes($data[5]) . '"'); ?>);
<?php
		}
		fclose($handle);
	}
?>
			}
		}());
	</script>
</body>
</html>