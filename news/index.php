<!DOCTYPE html>
<html>
<head>
	<title>Police Announcement</title>
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
		<h2>Message from your local police department</h2>
		<p>We're looking to question a suspect who might resemble this drawing. Please let us know if you have info about their whereabouts.</p>
		
		<img src="police-suspect.jpg" />
		
		<button class="win-button win-button-primary action" id="goToHome">
			<strong>Back to Home</strong>
		</button>
	</section>
	
	<script>
		var pageContent, goToHome;
		
		WinJS.UI.Pages.define("/news/", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				goToHome = document.getElementById("goToHome");
        		goToHome.addEventListener("click", transitionBetweenPages, false);
				
				WinJS.UI.Animation.enterPage(pageContent, null);
		    }
		});
		
		function transitionBetweenPages() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/home/");
	        });
		}
	</script>
</body>
</html>