<!DOCTYPE html>
<html>
<head>
	<title>Report Suspicious Activity using Picture</title>
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
</head>
<body>
	<section>
		<h2>Report Suspicious Activity</h2>
		<p>Please upload a picture or sketch of the activity or a target of interest related to your report.</p>
	
		<input type="file" id="file" />

		<button class="win-button win-button-primary action" id="goToNext">
			<strong>Upload File</strong>
		</button>
		<button class="win-button action" id="backFormPicture">
			Cancel
		</button>
	</section>
	
	<script>
		var pageContent, backFormPicture, goToNext;
		var hasFormData = false;
		var gps = null;
		
		WinJS.UI.Pages.define("/form/autofill-picture.php", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				goToNext = document.getElementById("goToNext");
        		goToNext.addEventListener("click", transitionToNext, false);

				backFormPicture = document.getElementById("backFormPicture");
        		backFormPicture.addEventListener("click", transitionToCancelPicture, false);

				gps = null;
				document.getElementById("file").onchange = function(e) { 
					EXIF.getData(e.target.files[0], function() {
						var tags = EXIF.getAllTags(this);
						if (tags.GPSLatitude && tags.GPSLongitude) {
							var latitude = tags.GPSLatitude[0] + tags.GPSLatitude[1]/60 + tags.GPSLatitude[2]/3600;
							var longitude = tags.GPSLongitude[0] + tags.GPSLongitude[1]/60 + tags.GPSLongitude[2]/3600;
							longitude *= tags.GPSLongitudeRef === "W" ? -1 : 1; 
							latitude *= tags.GPSLatitudeRef === "N" ? 1 : -1;
							gps = new Microsoft.Maps.Location(latitude, longitude);
						} else {
							gps = null;
						}
					});
				};

				hasFormData = WinJS.Navigation.state === "hasFormData";
				WinJS.UI.Animation.enterPage(pageContent, null);
		    }
		});
		
		function transitionToNext() {
			if (!document.getElementById("file").value) {
				alert("Please select a photo.");
				return;
			}
			g_picture = document.getElementById("file");
			g_location = gps;
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
				WinJS.Navigation.navigate((gps === null || hasFormData) ? "/form/" : "/form/autofill-location.php");	
	        });
		}
		
		function transitionToCancelPicture() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate(hasFormData ? "/form/" : "/home/");
	        });
		}
	</script>
</body>
</html>