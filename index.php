<!DOCTYPE html>
<html>
<head>
	<title>TraffickTips</title>
	<link href="/css/ui-light.css" rel="stylesheet" />
	<script src="/js/base.js"></script>
	<script src="/js/ui.js"></script>
	<script src="/js/default.js"></script>
	<script src="/js/navigator.js"></script>
	<script src="/js/exif.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="msapplication-tap-highlight" content="no" />
	<link href="/css/style.css" rel="stylesheet" /> 
	<script charset="UTF-8" type="text/javascript" src="https://ecn.dev.virtualearth.net/mapcontrol/mapcontrol.ashx?v=7.0&s=1"></script>
	
	<script>
		// Global variables
		var g_location = null;
	</script>
</head>
<body>
	<header>
		<h1>TraffickTips</h1>
	</header>

	<div id="splash">
		<div class="logo">TraffickTips</div>
		<div class="copyright">&copy Microsoft Corporation</div>
	</div>

	<div id="contenthost" data-win-control="Application.PageControlNavigator" data-win-options="{home: '/'}" ></div>
	
	<script>
		var splash;
		var splashLogo;
		var splashCopyright;
		
		WinJS.UI.Pages.define("/", {
		    ready: function (element, options) {
		        splash = document.querySelector("#splash");
				splashLogo = document.querySelector(".logo");
				splashCopyright = document.querySelector(".copyright");
		        setTimeout(transitionBetweenPages, 1000);
				WinJS.UI.Animation.enterPage([splashLogo, splashCopyright], null);
		    }
		});
		
		function transitionBetweenPages() {
		    WinJS.UI.Animation.exitPage([splash], null).done(function () {
	            WinJS.Navigation.navigate("/welcome/");
	        });
		}
	</script>
</body>
</html>