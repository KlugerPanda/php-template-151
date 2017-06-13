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
  	if ($this->registrierenService->register($data["username"], $data["email"], password_hash($data["password"], PASSWORD_DEFAULT), 
  			$data["passwordRepeat"]))
  	{
		echo "Sie haben ein Bestätigungs-E-Mail erhalten.";
  	}
  	
  }
  
  public function usernameCheck()
  {
  	
  }
  
  public function passwortCheck()
  {
  	
  }
  
  public function getLink()
  {
  	
  }

}













