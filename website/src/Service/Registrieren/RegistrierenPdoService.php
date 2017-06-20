<?php

namespace KlugerPanda\Service\Registrieren;

class RegistrierenPdoService implements RegistrierenService
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($username, $email, $password, $link) 
    {
        $stmt = $this->pdo->prepare("INSERT INTO user (username, email, passwort, link, status)
    	VALUES(?, ?, ?, ?, ?)");
    	$stmt->bindValue(1, $username);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $password);
        $stmt->bindValue(4, $link);
        $stmt->bindValue(5, 2);
        $stmt->execute();
		
        
        /*require_once '../vendor/autoload.php';
        
        // Create the Transport
        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465))
        ->setUsername("gibz.module.151@gmail.com")
        ->setPassword("Pe$6A+aprunu")
        ;
        
        // Create the Mailer using your created Transport
        $mailer = new Swift_Mailer($transport);
        
        // Create a message
        $message = (new Swift_Message('Email bestätigen'))
        ->setFrom(['patr.hens6@gmail.com' => 'Patrick Henseler'])
        ->setTo([$email => $username])
        ->setBody('Guten Tag ' .$username . '</br></br>Bitte bestätige deine E-Mail Adresse indem du auf folgegenden Link gehts.' . 
        		'<a href="https://'. $_SERVER['SERVER_NAME'] . "/Activate". $link)
        ;
        
        // Send the message
        $result = $mailer->send($message);
        */
        return true;
    }
    public function getAllUsernames($username)
    {
    	// $username vorgegebener Username
    	$stmt = $this->pdo->prepare("SELECT username FROM user");
    	$stmt->execute();
    	
    	$tester = 0;
    	foreach ($stmt as $row)
    	{
    		if(strtolower($username) === strtolower($row['username']))
    		{
    			$tester = 1;
    		}
    	}
    	if ($tester == 1)
    	{
    		return false;
    	}
    	else 
    	{
    		return true;
    	}
    }
    
    public function getAllLinks($username)
    {
    	// $username vorgegebener Username
    	$stmt = $this->pdo->prepare("SELECT link FROM user");
    	$stmt->execute();
    	 
    	$tester = 0;
    	foreach ($stmt as $row)
    	{
    		if(strtolower($link) == strtolower($row['link']))
    		{
    			$tester = 1;
    		}
    	}
    	if ($tester == 1)
    	{
    		return false;
    	}
    	else
    	{
    		return true;
    	}
    }
}
