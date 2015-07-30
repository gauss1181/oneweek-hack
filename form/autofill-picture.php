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
</head>
<body>
	<section>
		<h2>Report Suspicious Activity</h2>
		<p>Please upload a picture or sketch of the activity or a target of interest related to your report.</p>
	
		<input type="file" />

		<button class="win-button win-button-primary action" id="updateForm">
			<strong>Use Selected Picture</strong>
		</button>
		<button class="win-button action" id="backForm">
			Cancel
		</button>
	</section>
	
	<script>
		var pageContent, backForm, updateForm;
		var hasFormData = false;
		
		WinJS.UI.Pages.define("/form/autofill-picture.php", {
		    ready: function (element, options) {
				pageContent = document.querySelector(".pageContent");
				
				updateForm = document.getElementById("updateForm");
        		updateForm.addEventListener("click", transitionToForm, false);

				backForm = document.getElementById("backForm");
        		backForm.addEventListener("click", transitionToBack, false);

				hasFormData = WinJS.Navigation.state === "hasFormData";
				WinJS.UI.Animation.enterPage(pageContent, null);
		    }
		});
		
		function transitionToForm() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate("/form/");
	        });
		}
		
		function transitionToBack() {
		    WinJS.UI.Animation.exitPage(pageContent, null).done(function () {
	            WinJS.Navigation.navigate(hasFormData ? "/form/" : "/home/");
	        });
		}
	</script>
</body>
</html>