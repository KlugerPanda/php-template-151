<?php

namespace KlugerPanda\Controller;

use KlugerPanda\SimpleTemplateEngine;

class IndexController 
{
  /**
   * @var KlugerPanda\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @param KlugerPanda\SimpleTemplateEngine
   */
  public function __construct(\Twig_Environment $template)
  {
     $this->template = $template;
  }

  public function homepage() 
  {
    	echo '
    	<!Doctype>
    	<html>
    	<head>
		<link rel="stylesheet" href="stylesheet.css">
    	<title>Jodel</title>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  		<!-- Optional theme -->
  		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  		<!-- Latest compiled and minified JavaScript -->
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    	</head>
    	<body>
    	<div class="titel small-1 medium-1 large-1">
    		<h1>Blog von Patrick</h1>
    	</div>
    	<div class="anmelden small-2 medium-2 large-2">
    	' . $this->showLoginButton() . '
    	</div>
    		
    	<div class="content small-1 medium-3 large-3">
    	Leider wurde ich mit der Seite nicht fertig, da ich mich beim planen stark verschätz habe. Die funktionierenden Funktionen haben weitaus mehr Zeit beansprucht als ich geplant habe.
    	</div>
    		
    	<div class="well small-1 medium-3 large-3">
    	<center>Das ist mein Footer</center>
    	</div>
    	</body>
    	</html>
    	';
    	
    
  }
  
  public function showLoginButton()
  {
  	if (isset($_SESSION["username"]))
  	{
  		$button =  "Eingeloggt als: " . $_SESSION["username"] . "</br><a href='/ausloggen'><button class=''>Ausloggen</button></a>";
  	}
  	else 
  	{
  		$button =  "<a href='/login'><button class='btn btn-default'>Login</button></a>";
  	}
  	return $button;
  }

}
