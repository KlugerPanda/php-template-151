<?php
//session_regenerate_id();
require_once("../vendor/autoload.php");
$factory = KlugerPanda\Factory::createFromIniFile(__DIR__ . "/../config.ini");
session_start();
switch($_SERVER["REQUEST_URI"]) {
	case "/":
		$factory->getIndexController()->homepage();
		break;
	case "/login":
		$factory = $factory->getLoginController();
		if($_SERVER["REQUEST_METHOD"] === "GET") 
		{
			$factory->showLogin();
		} 
		else 
		{
			$factory->login($_POST);
		}
		break;
	case "/registrieren":
		$factory = $factory->getRegistrierenController();
		if($_SERVER["REQUEST_METHOD"] === "GET") 
		{
			$factory->showRegistrieren();
		} 
		else 
		{
			$factory->register($_POST);
		}
		break;
	default:
		echo "Not Found";
}

