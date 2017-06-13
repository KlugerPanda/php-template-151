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

  public function homepage() {
    echo "INDEX TEst";
  }

}
