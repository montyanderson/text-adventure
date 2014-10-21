<?php
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);

header("Content-type: text/plain");
session_start();

include("commands.php");
include("rooms.php");

$command = trim($_REQUEST["command"]);
$arguments = array();

foreach(explode(" ", $command) as $argument) {
	$arguments[] = htmlentities(strtolower(trim($argument)));
}

$output = array();
$output["response"] = commands($arguments);

if($_SESSION["adventure"] == false && $_SESSION["name_set"] == true && $_SESSION["age_set"] == true) {
   	$output["response"] .= "<br />Let's start the adventure, do <strong>adventure start</strong>!";
}

$output["data"] = array();
$output["data"]["name"]  = $_SESSION["name"];
$output["data"]["room"]  = $_SESSION["room"];
$output["data"]["age"]   = $_SESSION["age"];
$output["data"]["money"] = $_SESSION["money"];
$output["data"]["motd"]  = $_SESSION["motd"];

echo json_encode($output);
