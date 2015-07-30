<!DOCTYPE html>
<html>
<head>
	<title>Welcome to TraffickTips</title>
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
	<section class="pageContent">
		<div id="intro">
			<h2>Welcome!</h2>
			<p>TraffickTips allows citizens to report suspected human trafficking activities to the police, and allows the police to crowdsource tips from citizens in human trafficking cases. Let's work together to end human trafficking!</p>
		</div>
		
		<button class="win-button win-button-primary action" id="goToHelp">
			<strong>Next:</strong> Look for Red Flags
		</button>
	</section>
	
	<script>
		var header, pageContent, footer, goToHelp;
		
		WinJS.UI.Pages.define("/welcome/", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				footer = document.querySelector("footer");
				
				goToHelp = document.getElementById("goToHelp");
        		goToHelp.addEventListener("click", transitionBetweenPages, false);
				
				WinJS.UI.Animation.enterPage(pageContent, null);
		    }
		});
		
		function transitionBetweenPages() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/help/");
	        });
		}
	</script>
</body>
</html>
