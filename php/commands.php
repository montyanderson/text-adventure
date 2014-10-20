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
			$_SESSION["motd"] = "";
			$_SESSION["adventure"] = false;

			$_SESSION["name_set"] = false;
			$_SESSION["age_set"] = false;

			$output = "Welcome, to set your name and age, do:<br /><strong>name John<br />age 21</strong>";
			break;

		case "name":
			$_SESSION["name"] = ucfirst($arguments[1]);
			$output = "Welcome, <strong>" . $_SESSION["name"] . "</strong>.";
			$_SESSION["name_set"] = true;
			break;

		case "age":
			if(intval($arguments[1]) != 0 && intval($arguments[1]) < 120) {
				$_SESSION["age"] = intval($arguments[1]);
				$output = "So you're <strong>" . $_SESSION["age"] . "</strong>? That's a great age to be.";
				$_SESSION["age_set"] = true;
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
			break;

		case "adventure":
			if($arguments[1] == "start") {
				if($_SESSION["adventure"] == false) {
					$output = "I'm glad that you're ready to start, <strong>" . $_SESSION["name"] . "</strong>.";
					$_SESSION["adventure"] = true;
					$_SESSION["motd"] = "On an Adventure!";
				} else {
					$output = "You're already on an adventure!";
				}
			}
	}

	return $output;
}
