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
		
        
        $message =  \Swift_Message::newInstance()
        ->setSubject('Account Bestätigung')
        ->setFrom(array('patr.hens6@gmail.com' => 'Patrick Henseler'))
        ->setTo(array($email => $username))
        ->setBody('Hallo ' . $username . ',</br> Bitte bestätige deine Email <a href="https://'
        		. $_SERVER['SERVER_NAME'] . "/Activate". $link);
        		$this->getMailer()->send($message);
        return true;
    }
    public function getMailer()
    {
    	return \Swift_Mailer::newInstance(
    			\Swift_SmtpTransport::newInstance("smtp.gmail.com", 465, "ssl")
    			->setUsername("gibz.module.151@gmail.com")
    			->setPassword("Pe$6A+aprunu")
    			);
    }
    
}
