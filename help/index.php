<!DOCTYPE html>
<html>
<head>
	<title>Trafficking Indicators</title>
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
		<div id="intro">
			<h2>Trafficking Indicators</h2>
			<p>Here are some trafficking indicators that might point to illegal human trafficking. You'll want to keep these in mind when reporting suspicious activity. You can come back to this page anytime.</p>
		</div>
		
		<ul>
			<li>Is the victim in possession of identification and travel documents; if not, who has control of the documents?</li>
			<li>Was the victim coached on what to say to law enforcement and immigration officials?</li>
			<li>Was the victim recruited for one purpose and forced to engage in some other job?</li>
			<li>Is the victim's salary being garnished to pay off a smuggling fee?</li>
			<li>Was the victim forced to perform sexual acts?</li>
			<li>Does the victim have freedom of movement?</li>
		</ul>
		
		<button class="win-button win-button-primary action" id="goToHome">
			<strong>Let's get started!</strong>
		</button>
	</section>
	
	<script>
		var pageContent, goToHome;
		
		WinJS.UI.Pages.define("/help/", {
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