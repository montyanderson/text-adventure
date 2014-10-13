<?php

function commands($arguments) {
	$output; /* Define semi-global */

	switch($arguments[0]) {

		default:
			$output = "Sorry, I don't know that word.";
			break;

		case "init":
			$_SESSION["name"]  = "Anonymous";
			$_SESSION["room"]  = "Town Hall";
			$_SESSION["age"]   = 18;
			$_SESSION["money"] = 100;
			$_SESSION["adventure"] = false;

			$output = "Welcome, to set your name, do <strong>name YourName</strong>.";
			break;

		case "name":
			$_SESSION["name"] = ucfirst($arguments[1]);
			$output = "Welcome, <strong>" . $_SESSION["name"] . "</strong>.";
			break;

		case "age":
			if(intval($arguments[1]) != 0 && intval($arguments[1]) < 120) {
				$_SESSION["age"] = intval($arguments[1]);
				$output = "So you're <strong>" . $_SESSION["age"] . "</strong>? That's a great age to be.";
			} else {
				$output = "Sorry, but <strong>" . $arguments[1] .  "</strong> is not an age.";
			}
			break;

		case "room":
			if(count($arguments) == 1) {
				$output = "You are in room: <strong>" . $_SESSION["room"] . "</strong>.";
			} else {
				$output = "";
			}
			break;
			
			
		case "money":
			if(count($arguments) == 1) {
				$output = "You have £" . $_SESSION["money"];
			}
	}

	return $output;
}
