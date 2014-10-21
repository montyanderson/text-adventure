<?php

function commands($arguments) {
	$output = ""; /* Define semi-global */

	switch($arguments[0]) {

		default:
			$output = "Sorry, I don't know that word.";
			break;

		case "init":
			$_SESSION["name"]  = "Anonymous";
			$_SESSION["room"]  = "home";
			$_SESSION["age"]   = 18;
			$_SESSION["money"] = 100;
			$_SESSION["motd"] = "";
			$_SESSION["adventure"] = false;
			$_SESSION["step"];
			$_SESSION["name_set"] = false;
			$_SESSION["age_set"] = false;
			$_SESSION["rooms"] = rooms_init();
			$_SESSION["step"] = 0;
			$_SESSION["inventory"] = array("map", "keys");

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
						$output = "I'm glad that you're ready to start, <strong>" . $_SESSION["name"] . "</strong>.<br />";
						$output.= "Do <strong>pickup gun</strong> to start!";
						$_SESSION["adventure"] = true;
						$_SESSION["motd"] = "On an Adventure!";
					} else {
						$output = "You're already on an adventure!";
					}
			} else {
				$output = "Use <strong>adventure</strong> like this <strong>adventure start</strong>.";
			}
			break;

		case "list":
			switch($arguments[1]) {
				case "inventory":
					$split = "<strong>,</strong> ";

					foreach($_SESSION["inventory"] as $item) {
						$output .= $item . $split;
					}

					$output = substr($output, 0, 0 - strlen($split)); /* remove last comma and space */
					break;

				case "floor":
					$split = "<strong>,</strong> ";

					foreach($_SESSION["rooms"][$_SESSION["room"]]["floor"] as $item) {
						$output .= $item . $split;
					}

					$output = substr($output, 0, 0 - strlen($split)); /* remove last comma and space */
					break;
			}
			break;



		case "room":
			$output = $_SESSION["room"];
			break;

		case "pickup":
			$items = $_SESSION["rooms"][$_SESSION["room"]]["floor"]; /* can't place whole line in parser */

			if(in_array($arguments[1], $items)) {
				$_SESSION["inventory"][] = $arguments[1]; /* add item to inventory */
				$key = array_search($arguments[1], $_SESSION["rooms"][$_SESSION["room"]]["floor"]); /* get key of item in array */
				unset($_SESSION["rooms"][$_SESSION["room"]]["floor"][$key]); /* remove the item from the floor */

				if($arguments[1] == "gun") {
					$_SESSION["motd"] = "Has a gun!";
				}

				if($arguments[1] == "coat") {
					$_SESSION["motd"] = "Wearing a coat!";
				}

				$output = "<strong>" . $arguments[1] . "</strong> is now in your inventory.";
			} else {
				$output = "<strong>" . $arguments[1] . "</strong> isn't on the floor.";
			}

			break;
	}

	return $output;
}
