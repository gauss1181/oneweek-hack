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
		
		<form>
			<div style="overflow: hidden">
				<div style="position: relative; float: left;">
					<a href="/form/autofill-picture.php" id="changePicture" style="display: block;">
						<img src="sketchy.jpg" style="width: 100%; max-height: 120px;" />
						<span style="position: absolute; padding: 0 10px; bottom: 10px; right: 5px; text-decoration: none; border-radius: 10px; line-height: 20px; background: #FFF; display: block; text-align: center; color: #CC0000;">Change Photo</span>
					</a>
				</div>
				<div style="position: relative; float: left; margin-left: 10px;">
					<a href="/hawkeye/" style="display: block;">
						<img src="location.png" style="width: 100%; max-height: 120px;" />
						<span style="position: absolute; padding: 0 10px; bottom: 10px; right: 5px; text-decoration: none; border-radius: 10px; line-height: 20px; background: #FFF; display: block; text-align: center; color: #CC0000;">Adjust Location</span>
					</a>
				</div>
			</div>
			
			<p>Please describe what makes this activity suspicious:<br />
			<textarea name="why"></textarea></p>
			
			<p>Please give us information to help us identify the target. Include any IDs, names, and appearance.<br />
			<textarea name="what"></textarea></p>
		</form>	
		
		<button class="win-button win-button-primary action" id="goToThanks">
			<strong>Submit</strong>
		</button>
		<button class="win-button action" id="cancelForm">
			Cancel
		</button>
	</section>
	
	<script>
		var pageContent, changePicture, cancelForm, goToThanks;
		
		WinJS.UI.Pages.define("/form/", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				changePicture = document.getElementById("changePicture");
        		changePicture.addEventListener("click", transitionChangePicture, false);
				
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
		
		function transitionToThanks() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/form/thanks.php");
	        });
		}
		
		function transitionToHome() {
			if (confirm("Are you sure you want to cancel?")) {
			    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
		            WinJS.Navigation.navigate("/home/");
		        });
			}
		}
	</script>
</body>
</html>