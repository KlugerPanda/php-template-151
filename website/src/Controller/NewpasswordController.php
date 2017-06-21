<?php

namespace KlugerPanda\Controller;

use KlugerPanda\SimpleTemplateEngine;
use KlugerPanda\Service\Newpassword\NewpasswordService;

class NewpasswordController
{
	/**
	 * @var KlugerPanda\SimpleTemplateEngine Template engines to render output
	 */
	private $template;

	private $newpasswordService;


	public function __construct(SimpleTemplateEngine $template, NewpasswordService $NewpasswordService)
	{
		$this->template = $template;
		$this->newpasswordService = $NewpasswordService;
	}

	public function showPasswordAnfordern()
	{
		echo $this->template->render("newpassword.html.php");
	}
	
	public function newPasswordAnfordern(array $data)
	{
		$username = $this->newpasswordService->getUsername($data['email']);
		$email = $this->newpasswordService->getEmail($data['email']);
		$link = $this->newpasswordService->getLink($data['email']);
		if ($this->newpasswordService->neuesPassword($data['email']))
		{
			$message =  \Swift_Message::newInstance()
			->setSubject('Account Bestätigung')
			->setFrom(array('patr.hens6@gmail.com' => 'Patrick Henseler'))
			->setTo(array($email=> $username))
			->setBody('Hallo ' . $username . ',</br></br> Sie können ihr Passwort neu setzten, indem Sie auf folgenden Link gehen.</br><a href="https://'
					. $_SERVER['SERVER_NAME'] . "/activate=" . $link. '">Hier</a>', 'text/html')
					->setContentType("text/html");
			
					echo '<div class="alert alert-success" role="alert">Sie haben ein Link per e-mail erhalten, um Ihr Passwort zurückzusetzen.</div>';
				return $message;
		}
		else 
		{
			echo "Falsche eingabe";
		}
	}
	
	

}













