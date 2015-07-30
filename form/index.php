<!DOCTYPE html>
<html>
<head>
	<title>Report Activity</title>
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
</head>
<body>
	<section>
		<h2>Report Suspicious Activity</h2>
		
		<div style="overflow: hidden">
			<div style="position: relative; float: left; margin-right: 10px;">
				<a href="/form/autofill-picture.php" id="changePicture" style="display: block;">
					<img id="pictureImage" />
					<span style="position: absolute; padding: 0 10px; bottom: 10px; right: 5px; text-decoration: none; border-radius: 10px; line-height: 20px; background: #FFF; display: block; text-align: center; color: #CC0000;">Change Photo</span>
				</a>
			</div>
			<div style="position: relative; float: left;">
				<a href="/form/autofill-location.php" id="changeLocation" style="display: block;">
					<img id="locationImage" />
					<span style="position: absolute; padding: 0 10px; bottom: 10px; right: 5px; text-decoration: none; border-radius: 10px; line-height: 20px; background: #FFF; display: block; text-align: center; color: #CC0000;">Adjust Location</span>
				</a>
			</div>
		</div>

		<form method="POST" enctype="multipart/form-data">
			
			<p>Please describe what makes this activity suspicious:<br />
			<textarea name="why" id="whyField"></textarea></p>
			
			<p>Please give us information to help us identify the target. Include any IDs, names, and appearance.<br />
			<textarea name="what" id="whatField"></textarea></p>
		</form>	
		
		<button class="win-button win-button-primary action" id="goToThanks">
			<strong>Submit</strong>
		</button>
		<button class="win-button action" id="cancelForm">
			Discard
		</button>
	</section>
	
	<script>
		(function () {
			var pageContent, changePicture, cancelForm, goToThanks;
			var whyField, whatField;
			
			WinJS.UI.Pages.define("/form/", {
			    ready: function (element, options) {
					pageContent = document.querySelector(".pageContent");
					
					whyField = document.getElementById("whyField");
					whyField.value = g_why;
					whatField = document.getElementById("whatField");
					whatField.value = g_what;
					
					changePicture = document.getElementById("changePicture");
	        		changePicture.addEventListener("click", transitionChangePicture, false);
					if (g_picture) {
						var FR= new FileReader();
				        FR.onload = function(e) {
				             document.getElementById("pictureImage").src = e.target.result;
				        };
				        FR.readAsDataURL(g_picture.files[0]);
					}
					
					changeLocation = document.getElementById("changeLocation");
	        		changeLocation.addEventListener("click", transitionChangeLocation, false);
					if (g_gps) {
						document.getElementById("locationImage").src = "http://dev.virtualearth.net/REST/V1/Imagery/Map/Road/"+g_gps.latitude+","+g_gps.longitude+"/15?pushpin="+g_gps.latitude+","+g_gps.longitude+";55&mapSize=120,120&key=Au_kHqNbZbddwJUaoPTz-tfjHTfZtuPYiBifygz7YU3Y8QpyERxo_Qs2tnitGcGn";
					}
					
					goToThanks = document.getElementById("goToThanks");
	        		goToThanks.addEventListener("click", transitionToThanks, false);
	
					cancelForm = document.getElementById("cancelForm");
	        		cancelForm.addEventListener("click", transitionToHome, false);
					
					WinJS.UI.Animation.enterPage(pageContent, null);
			    }
			});
			
			function transitionChangePicture(e) {
				e.preventDefault();
			    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
		            WinJS.Navigation.navigate("/form/autofill-picture.php", "hasFormData");
		        });
			}
			
			function transitionChangeLocation(e) {
				e.preventDefault();
			    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
		            WinJS.Navigation.navigate("/form/autofill-location.php", "hasFormData");
		        });
			}
			
			function transitionToThanks() {
				if (!g_gps) {
					alert("Please identify a location for this target.");
					return;
				}
				if (whatField.value === "") {
					alert("Please give a description of the target you're referring to.");
					return;
				}
				if (whyField.value === "") {
					alert("Please let us know what make you think this target is suspicious.");
					return;
				}

				var dataToSend = new FormData();
				dataToSend.append("latitude", g_gps.latitude);
				dataToSend.append("longitude", g_gps.longitude)
				dataToSend.append("why", whyField.value);
				dataToSend.append("what", whatField.value);
					
				if (g_picture) {
					var url = URL.createObjectURL(g_picture.files[0]);
					WinJS.xhr({ url: url, responseType: 'blob' }).done(function (req) {
		    			var blob = req.response;
						dataToSend.append("picture", blob, g_picture.files[0].name);
						WinJS.xhr({
							url: "/ajax/sendreport.php",
							type: "POST",
							data: dataToSend
						}).then(afterUploadTransitionToThanks);
					});
				} else {
					WinJS.xhr({
						url: "/ajax/sendreport.php",
						type: "POST",
						data: dataToSend
					}).then(afterUploadTransitionToThanks);
				}
			}
			
			function afterUploadTransitionToThanks() {
				g_picture = null;
				g_gps = null;
				g_why = "";
				g_what = "";
			    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
		            WinJS.Navigation.navigate("/form/thanks.php");
		        });
			}
			
			function transitionToHome() {
				if (confirm("Are you sure you want to discard this report?")) {
					g_picture = null;
					g_gps = null;
					g_why = "";
					g_what = "";
				    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
			            WinJS.Navigation.navigate("/home/");
			        });
				}
			}
		}());
	</script>
</body>
</html>