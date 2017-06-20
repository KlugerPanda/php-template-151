<?php

namespace KlugerPanda\Service\Login;

class LoginPdoService implements LoginService
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function authenticate($username, $password) 
    {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE (username=? OR email=?) AND status=1");
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $username);
        $stmt->execute();
        
        $tester = 0;
		foreach ($stmt as $row)
		{
			if(password_verify($password, $row["passwort"]))
			{
				$tester = 1;
			}
		}
		if ($tester == 1)
		{
			$_SESSION["username"] = $stmt->username;
			$_SESSION["email"] = $stmt->email;
			return true;
		}
		else 
		{
			echo "Falsche Benutzerdaten, falls Sie sich neu registriert haben, müssen Sie zuerst Ihre E-Mail Adresse bestätigen.";
			return false;
		}
        

    }
}
