<?php

namespace KlugerPanda\Controller;

use KlugerPanda\SimpleTemplateEngine;
use KlugerPanda\Service\Login\LoginService;

class LoginController 
{
  /**
   * @var KlugerPanda\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @var KlugerPanda\Service\Login\LoginService
   */
  private $loginService;
  
  /**
   * @param KlugerPanda\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, LoginService $loginService)
  {
     $this->template = $template;
     $this->loginService = $loginService;
  }
  
  public function showLogin()
  {
  	 echo $this->template->render("login.html.php");
  }
  
  public function login(array $data)
  {
  	if(!array_key_exists("email", $data) OR !array_key_exists("password", $data)) 
  	{
  		$this->showLogin();
  		return;
  	}
  	if ($data['CSRF'] != $_SESSION['CSRF'])
  	{
  		$this->showLogin();
  		return;
  	}
  	
  	if($this->loginService->authenticate($data["email"], $data["password"])) 
  	{
  		// header('location: /', 0);  Funktioniert nicht
  	} 
  	else 
  	{
  		echo $this->template->render("login.html.php", [
  			"email" => $data["email"]		
  		]);
  	}
  }
}












