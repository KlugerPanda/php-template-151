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
  	// Hier kommt die fast komplette HTML Seite rein (Aufteilen in diverse login.html.php Files)
    if (isset($_SESSION["username"]))
    {
    	echo "Hallo" . $_SESSION['username'];
    }
    else 
    {
    	echo "Melde dich an um die gesamte Funktionalität der Seite zu verwenden.";
    	echo "</br>";
    	echo "<a href='https://localhost/login'>Hier geht's zum Login</a>";
    }
  }
  public function showLoginButton()
  {
  	if (isset($_SESSION["username"]))
  	{
  		echo "<a href='/ausloggen'><button>Ausloggen</button></a>";
  	}
  	else 
  	{
  		echo "<a href='/login'><button>Login</button></a>";
  	}
  }

}
