<?php

namespace KlugerPanda\Service\Newpassword;

class NewpasswordPdoService implements NewpasswordService
{
	/**
	 * @var \PDO
	 */
	private $pdo;

	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	// Link anfordern
	public function neuesPassword($email)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE (username=? OR email=?)");
		$stmt->bindValue(1, htmlentities($email));
		$stmt->bindValue(2, htmlentities($email));
		$stmt->execute();
		$tester = 0;
		foreach ($stmt as $row)
		{
			$tester = 1;
			if ($row["status"] == 1)
			{
				return true;
			}
			else
			{
				echo '<div class="alert alert-info" role="alert">Sie müssen zuerst Ihre Email bestätigen, bevor sie Ihr Passwort neu anfordern können</div>';
				return false;
			}
		}

	}
	
	public function getUsername($email)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE (username=? OR email=?)");
		$stmt->bindValue(1, htmlentities($email));
		$stmt->bindValue(2, htmlentities($email));
		$stmt->execute();
		$username = "";
		foreach ($stmt as $row)
		{
			$username = $row['username'];
		}
		return $username;
	}
	
	public function getEmail($email)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE (username=? OR email=?)");
		$stmt->bindValue(1, htmlentities($email));
		$stmt->bindValue(2, htmlentities($email));
		$stmt->execute();
		$emailReturn = "";
		foreach ($stmt as $row)
		{
			$emailReturn = $row['email'];
		}
		return $emailReturn;
	}
	
	public function getLink($email)
	{
		$link = "";
		$zeichen = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
				'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!', '$', '?', 
				'1', '2', '3', '4', '5', '6', '7,' ,'8', '9');
		do
		{
			for ($i = 0; $i < 25; $i++)
			{
				$randomNumber =  rand(0, count($zeichen));
				$link = $link . $zeichen[$randomNumber];
			}
		} while (!$this->linkCheck($link));
		$stmt = $this->pdo->prepare("UPDATE user SET link=? WHERE (username=? OR email=?)");
		$stmt->bindValue(1, $link);
		$stmt->bindValue(2, htmlentities($email));
		$stmt->bindValue(3, htmlentities($email));
		$stmt->execute();
		return $link;
	}
	public function linkCheck($link)
	{
		// prüfen ob link noch ungebraucht ist.
		$stmt = $this->pdo->prepare("SELECT link FROM user");
		$stmt->execute();
		
		$tester = true;
		foreach ($stmt as $row)
		{
			if($link == $row['link'])
			{
				$tester = false;
			}
		}
		return $tester;
	}
	
	// Link prüfen
	public function richtigerLink($link)
	{
		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE link=?");
		$stmt->bindValue(1, $link);
		$stmt->execute();
		return $stmt->rowCount();
	}
	
	// Passwort ändern
	public function passwordAendern($password, $password2, $link)
	{
		if ($this->passwortSicherheit($password) && $this->passwortCheck($password, $password2))
		{
			// passwort ändern
			$stmt = $this->pdo->prepare("UPDATE user SET passwort=? WHERE link=?");
			$stmt->bindValue(1, password_hash($password, PASSWORD_DEFAULT));
			$stmt->bindValue(2, $link);
			$stmt->execute();
			return true;
		}
		else 
		{
			return false;
		}
	}
	
	public function passwortSicherheit($password)
	{
		return preg_match("#.*^(?=.{8,20})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).*$#", $password);
	}
	public function passwortCheck($password, $passwordRepeat)
	{
		if ($password == $passwordRepeat)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
