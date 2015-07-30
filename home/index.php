<!DOCTYPE html>
<html>
<head>
	<title>TraffickTips</title>
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
		<article>
			<h3>Message from your local police department:</h3>
			<button class="win-button" id="goToNews">
				Read Announcement
			</button>
		</article>
		
		<p>See suspicious activity? Use the buttons to report it. <a href="/help/" id="linkToHelp">What are the red flags I should look for?</a></p>

		<button class="win-button win-button-primary action" id="goToPicker">
			<strong>Use a Picture</strong>
		</button>
		<button class="win-button win-button-primary action" id="goToForm">
			<strong>Manual Entry</strong>
		</button>
	</section>
	
	<script>
		var pageContent, linkToHelp, goToPicker, goToForm, goToNews;
		
		WinJS.UI.Pages.define("/home/", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				linkToHelp = document.getElementById("linkToHelp");
        		linkToHelp.addEventListener("click", transitionToHelp, false);
				
				goToPicker = document.getElementById("goToPicker");
        		goToPicker.addEventListener("click", transitionToPicker, false);
				
				goToForm = document.getElementById("goToForm");
        		goToForm.addEventListener("click", transitionToForm, false);
				
				goToNews = document.getElementById("goToNews");
        		goToNews.addEventListener("click", transitionToNews, false);
				
				WinJS.UI.Animation.enterPage(pageContent, null);
		    }
		});
		
		function transitionToHelp(e) {
			e.preventDefault();
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/help/");
	        });
		}
		
		function transitionToPicker() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/form/autofill-picture.php");
	        });
		}
		
		function transitionToForm() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/form/");
	        });
		}
		
		function transitionToNews() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/news/");
	        });
		}
	</script>
</body>
</html>