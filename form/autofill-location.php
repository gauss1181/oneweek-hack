<!DOCTYPE html>
<html>
<head>
	<title>Report Suspicious Activity using Picture</title>
	<link href="/css/ui-light.css" rel="stylesheet" />
	<script src="/js/base.js"></script>
	<script src="/js/ui.js"></script>
	<script src="/js/default.js"></script>
	<script src="/js/navigator.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="msapplication-tap-highlight" content="no" />
	<link href="/css/style.css" rel="stylesheet" />
	<script charset="UTF-8" type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1"></script>
</head>
<body>
	<div id='mapDiv'></div>
	<script type="text/javascript">
		var pushpin;
		function InitMap() {
			var map;
			var gps = g_location;
			
			Microsoft.Maps.loadModule('Microsoft.Maps.Themes.BingTheme', { callback: themesModuleLoaded });
			function themesModuleLoaded() {
				Microsoft.Maps.loadModule('Microsoft.Maps.Overlays.Style', { callback: GetMap });
			}

			function shapesModuleLoaded() {
				/* var options = {
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
         		map.entities.push(polygonWithHoles); */
			}

			function insertPins() {
				var options = {
					draggable: true
				}
				pushpin = new Microsoft.Maps.Pushpin(gps, options);
         		map.entities.push(pushpin);
			}

			function GetMap() {
				if (gps === null) {
					gps = new Microsoft.Maps.Location(47.642067, -122.127276);
				}
				var options = {
					credentials:"Au_kHqNbZbddwJUaoPTz-tfjHTfZtuPYiBifygz7YU3Y8QpyERxo_Qs2tnitGcGn",
					center: gps,
                    mapTypeId: Microsoft.Maps.MapTypeId.road,
                    zoom: 15,
					customizeOverlays: true,
					theme: new Microsoft.Maps.Themes.BingTheme() 
				};
				map = new Microsoft.Maps.Map(document.getElementById("mapDiv"), options);
				Microsoft.Maps.loadModule('Microsoft.Maps.AdvancedShapes', { callback: shapesModuleLoaded });
				insertPins();
			}
		}
	</script>
	
	<section class="pageContent" style="position: fixed; bottom: 0; left: 0; right: 0; z-index: 1; pointer-events: none;">
		<p>Drag the dot to the location of interest</p>
		<button class="win-button win-button-primary action" id="updateForm" style="pointer-events: all;">
			<strong>Confirm Location</strong>
		</button>
		<button class="win-button action" id="backFormLocation" style="pointer-events: all;">
			Cancel
		</button>
	</section>
	
	<script>
		var pageContent, backFormLocation, updateForm;
		var hasFormData = false;
		
		WinJS.UI.Pages.define("/form/autofill-location.php", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				updateForm = document.getElementById("updateForm");
        		updateForm.addEventListener("click", transitionToForm, false);

				backFormLocation = document.getElementById("backFormLocation");
        		backFormLocation.addEventListener("click", transitionToBack, false);

				hasFormData = WinJS.Navigation.state === "hasFormData";
				WinJS.UI.Animation.enterPage([document.getElementById("mapDiv"), pageContent], null);
				InitMap();
		    }
		});
		
		function transitionToForm() {
			g_location = pushpin.getLocation();
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/form/");
	        });
		}
		
		function transitionToBack() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate(hasFormData ? "/form/" : "/form/autofill-picture.php");
	        });
		}
	</script>
</body>
</html>