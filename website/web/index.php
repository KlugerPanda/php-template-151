<?php
//session_regenerate_id();
require_once("../vendor/autoload.php");
$factory = KlugerPanda\Factory::createFromIniFile(__DIR__ . "/../config.ini");
if (!isset($_SESSION["username"]))
{
	session_start();
}
?>
<link rel="stylesheet" href="stylesheets/stylesheet.css">
<?php 
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
	case "/ausloggen":
		$_SESSION = array();
		session_destroy();
		header('location: /', 0);
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
			$factory->getMailer()->send($message);
		}
		break;
	case "/newPassword":
		$newpasswordController = $factory->getNewpasswordController();
		if($_SERVER["REQUEST_METHOD"] === "GET")
		{
			$newpasswordController->showPasswordAnfordern();
		}
		else
		{
			$message = $newpasswordController->newPasswordAnfordern($_POST);
			$factory->getMailer()->send($message);
		}
		break;
	default:
		$matches = [];
		if(preg_match("|^/activate=(.+)$|", $_SERVER["REQUEST_URI"], $matches)) 
		{
			$activateController = $factory->getActivateController();
			$activateController->activate($matches[1]);
			break;
		}
		else if (preg_match("|^/setNewPassword=(.+)$|", $_SERVER["REQUEST_URI"], $matches))
		{
			if($_SERVER["REQUEST_METHOD"] === "GET")
			{
				$newpasswordController = $factory->getNewpasswordController();
				$newpasswordController->showNewpasswordForm($matches[1]);
			}
			else
			{
				// Passwort ändern
				$newpasswordController = $factory->getNewpasswordController();
				$newpasswordController->changePassword($_POST, $matches[1]);
			}
		}
		else 
		{
			echo "Not Found";
		}
}

