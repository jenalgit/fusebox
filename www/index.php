<?php
	ob_start(); //Buffer output

	//Standard Includes
	include("includes/global.php");

	$request = $ROUTER->routeInfo();

	if(!$USER->loaded()) {
		include($BASEPATH."partials/header.php");
		include($BASEPATH."partials/login.php");
		include($BASEPATH."partials/footer.php");
	} else {
		if(empty($request['args'][2])) {
			//User is logged in, show dashboard.
			include($BASEPATH."partials/header.php");
			include($BASEPATH."partials/navbar.php");
			include($BASEPATH."partials/dashboard.php");
			include($BASEPATH."partials/footer.php");
		} else {
			//Process argument
			include($BASEPATH."partials/header.php");
			include($BASEPATH."partials/navbar.php");

			if(file_exists($BASEPATH."partials/".$request['args'][2].".php")) {
				require($BASEPATH."partials/".$request['args'][2].".php");
			} else
				require($BASEPATH."partials/error.php");

			include($BASEPATH."partials/footer.php");
		}	
	}

	

	$pageContents = ob_get_contents();
	ob_end_clean();
	echo str_replace ('<!--TITLE-->', $SETTINGS->get("general_display_name")." - ".$page_title, $pageContents);
?>