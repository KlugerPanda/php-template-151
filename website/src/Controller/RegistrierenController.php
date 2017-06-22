<?php

namespace KlugerPanda\Controller;

use KlugerPanda\SimpleTemplateEngine;
use KlugerPanda\Service\Registrieren\RegistrierenService;

class RegistrierenController 
{
  /**
   * @var KlugerPanda\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @var KlugerPanda\Service\Login\LoginService
   */
  private $registrierenService;
  
  /**
   * @param KlugerPanda\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, RegistrierenService $registrierenService)
  {
     $this->template = $template;
     $this->registrierenService = $registrierenService;
  }
  
  public function showRegistrieren()
  {
  	 echo $this->template->render("registrieren.html.php");
  }
  
  public function register(array $data)
  {
  	if(!array_key_exists("username", $data) OR !array_key_exists("email", $data) OR 
  			!array_key_exists("password", $data) OR !array_key_exists("passwordRepeat", $data)) {
  		$this->showRegistrieren();
  		return;
  	}
  	if ($data['CSRF'] != $_SESSION['CSRF'])
  	{
  		$this->showRegistrieren();
  		return;
  	}
  	$link = $this->getLink();
  	if (!$this->usernameCheck($data['username']))
  	{
  		$this->showRegistrieren();
  		echo '<div class="alert alert-danger" role="alert">Username bereits vergeben!</div>';
  		return;
  	}
  	if (!$this->emailCheck($data['email']))
  	{
  		$this->showRegistrieren();
  		echo '<div class="alert alert-danger" role="alert">Email wird bereits verwendet.</div>';
  		return;
  	}
  	if (!$this->passwortCheck($data['password'], $data['passwordRepeat']))
  	{
  		$this->showRegistrieren();
  		echo '<div class="alert alert-danger" role="alert">Passwörter stimmen nicht überein!"</div>';
  		return;
  	}
  	if (!$this->passwortSicherheit($data['password']))
  	{
  		$this->showRegistrieren();
  		echo '<div class="alert alert-danger" role="alert">Ihr Passwort muss mindestens eine Zahl, 
  				ein Kleinbuchstabe sowie einen Grossbuchstabe beinhalten. Ausserdem muss es mindestens 8 Zeichen lang sein."</div>';
  		return;
  	}
  	if ($this->registrierenService->register($data["username"], $data["email"], password_hash($data["password"], PASSWORD_DEFAULT), 
  			$link))
  	{
  		$message =  \Swift_Message::newInstance()
  		->setSubject('Account Bestätigung')
  		->setFrom(array('patr.hens6@gmail.com' => 'Patrick Henseler'))
  		->setTo(array($data["email"] => $data["username"]))
  		->setBody('Hallo ' . $data["username"] . ',</br></br> Bitte bestätige deine Email, indem Sie auf folgenden Link gehen.</br><a href="https://'
  				. $_SERVER['SERVER_NAME'] . "/activate=" . $link. '">Hier</a>', 'text/html')
  				->setContentType("text/html");
  		
  		echo '<div class="alert alert-success" role="alert">Erfolgreich registriert. Sie haben ein Bestätigungs-E-Mail erhalten.</div>';
  		return $message;
  	}
  	
  }
  public function emailCheck($email)
  {
  	// prüfen ob Email noch frei ist.
  	if ($this->registrierenService->getAllEmails($email))
  	{
  		return true;
  	}
  	else
  	{
  		return false;
  	}
  }
  public function usernameCheck($username)
  {
  	// prüfen ob Username noch frei ist.
  	if ($this->registrierenService->getAllUsernames($username))
  	{
  		return true;
  	}
  	else 
  	{
  		return false;
  	}
  }
  public function passwortSicherheit($password)
  {
  		return preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password);
  }
  public function passwortCheck($password, $passwordRepeat)
  {
  	if ($password == $passwordRepeat)
  	{
  		return true;
  	}
  	else 
  	{
  		return false;
  	}
  }
  
  public function getLink()
  {
  	$link = "";
  	$zeichen = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z', 
  			'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!', '$', '?',
			 '1', '2', '3', '4', '5', '6', '7,' ,'8', '9');
  	do 
  	{
  		for ($i = 0; $i < 25; $i++)
  		{
  			$randomNumber =  rand(0, count($zeichen));
  			$link = $link . $zeichen[$randomNumber];
  		}
  	} while (!$this->linkCheck($link));
  	return $link;
  }
  public function linkCheck($link)
  {
  	// prüfen ob link noch ungebraucht ist.
  	if ($this->registrierenService->getAllLinks($link))
  	{
  		return true;
  	}
  	else
  	{
  		return false;
  	}
  }

}













