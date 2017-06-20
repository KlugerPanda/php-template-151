<?php
//session_regenerate_id();
require_once("../vendor/autoload.php");
$factory = KlugerPanda\Factory::createFromIniFile(__DIR__ . "/../config.ini");
session_start();
$_SESSION = array();
session_destroy();
switch($_SERVER["REQUEST_URI"]) {
	case "/":
		$factory->getIndexController()->homepage();
		break;
	case "/login":
		$loginController = $factory->getLoginController();
		if($_SERVER["REQUEST_METHOD"] === "GET") 
		{
			$loginController->showLogin();
		} 
		else 
		{
			$loginController->login($_POST);
		}
		break;
	case "/registrieren":
		$registrierenController = $factory->getRegistrierenController();
		if($_SERVER["REQUEST_METHOD"] === "GET") 
		{
			$registrierenController->showRegistrieren();
		} 
		else 
		{
			$message = $registrierenController->register($_POST);
			//$factory->getMailer()->send($message);
		}
		break;
	case "/activate":
		break;
	default:
		$matches = [];
		if(preg_match("|^/activate=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) 
		{
			$activateController = $factory->getActivateController();
			$activateController->activate($matches[1]);
			break;
		}
		else 
		{
			echo "Not Found";
		}
}

