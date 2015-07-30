<!DOCTYPE html>
<html>
<head>
	<title>Hawkeye | TraffickTips</title>
	<script charset="UTF-8" type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1"></script>
	<style>
		body { margin: 0; font: 12pt/1.5 sans-serif; }
		#mapDiv { position: fixed; top: 50px; left: 0; bottom: 0; right: 0; }
		header { padding: 15px; line-height: 20px; background: #333; font-size: 120%; color: #FFF; }
	</style>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</script>
</head>
<body>
	<header>
		TrafficTips HawkEye
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
					new Microsoft.Maps.Location(41.885763, -87.635316),
					new Microsoft.Maps.Location(41.883686, -87.635273),
					new Microsoft.Maps.Location(41.884980, -87.633363),
					new Microsoft.Maps.Location(41.885763, -87.635316)
				];
				var polygonWithHoles = new Microsoft.Maps.Polygon(vertices, options);
         		map.entities.push(polygonWithHoles);
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

			function insertPins() {
				var location = new Microsoft.Maps.Location(41.884763, -87.634316);
				var pushpin = new Microsoft.Maps.Pushpin(location);
				var infobox = makeInfobox(pushpin, "http://twt-thumbs.washtimes.com/media/image/2012/12/13/border_web_20121213_0002_c0-43-720-462_s561x327.jpg?1afb64b1067aade7693a9e18f94938dd0f45eeb2");
				pushpin.setOptions({
					infobox: infobox
				});
         		map.entities.push(pushpin);
			}

			function GetMap() {
				var options = {
					credentials:"Au_kHqNbZbddwJUaoPTz-tfjHTfZtuPYiBifygz7YU3Y8QpyERxo_Qs2tnitGcGn",
					center: new Microsoft.Maps.Location(41.884490, -87.632704),
                    mapTypeId: Microsoft.Maps.MapTypeId.road,
                    zoom: 15,
					customizeOverlays: true,
					theme: new Microsoft.Maps.Themes.BingTheme() 
				};
				map = new Microsoft.Maps.Map(document.getElementById("mapDiv"), options);
				Microsoft.Maps.loadModule('Microsoft.Maps.AdvancedShapes', { callback: shapesModuleLoaded });
				insertPins();
			}
		}());
	</script>
</body>
</html>