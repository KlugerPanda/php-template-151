<?php 

namespace KlugerPanda;

class Factory 
{
	private $config;
	public static function createFromIniFile($filename)
	{
		return new Factory(
			parse_ini_file($filename, true)
		);
	}
	public function __construct(array $config)
	{
		$this->config = $config;
	}
	
	public function getTemplateEngine()
	{
		return new SimpleTemplateEngine(__DIR__ . "/../templates/");
	}
	
	public function getIndexController()
	{
		return new Controller\IndexController(
			$this->getTwigEngine()		
		);
	}
	
	private function getTwigEngine()
	{
		$loader = new \Twig_Loader_Filesystem(__DIR__ . "/../templates/");
		
		return new \Twig_Environment($loader);
	}
	
	public function getPdo()
	{
		return new \PDO(
			"mysql:host=mariadb;dbname=app;charset=utf8",
			$this->config["database"]["user"],
			"my-secret-pw",
			[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
		);
	}

	// Login
	public function getLoginController()
	{
		return new Controller\LoginController(
				$this->getTemplateEngine(),
				$this->getLoginService()
				);
	}
	public function getLoginService()
	{
		return new Service\Login\LoginPdoService($this->getPdo());
	}
	
	// Registrieren
	public function getRegistrierenController()
	{
		return new Controller\RegistrierenController(
				$this->getTemplateEngine(),
				$this->getRegistrierenService()
				);
	}
	public function getRegistrierenService()
	{
		return new Service\Registrieren\RegistrierenPdoService($this->getPdo());
	}
	
	

}
