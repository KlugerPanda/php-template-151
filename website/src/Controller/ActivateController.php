<?php

namespace KlugerPanda\Controller;

use KlugerPanda\SimpleTemplateEngine;
use KlugerPanda\Service\Activate\ActivateService;

class ActivateController
{
	/**
	 * @var KlugerPanda\SimpleTemplateEngine Template engines to render output
	 */
	private $template;

	private $activateService;
	/**
	 * @param KlugerPanda\SimpleTemplateEngine
	 */
	public function __construct(SimpleTemplateEngine $template, ActivateService $activateService)
	{
		$this->template = $template;
		$this->activateService = $activateService;
	}

	public function activate($link)
	{
		//echo $link;
		if ($this->activateService->activate($link))
		{
			echo "Ihr Account wurde erfolgreich bestätigt.";
		}
		else 
		{
			echo "Falscher Link";
		}
	}

}
