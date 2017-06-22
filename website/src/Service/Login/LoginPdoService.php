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
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE (username=? OR email=?)");
        $stmt->bindValue(1, htmlentities($username));
        $stmt->bindValue(2, htmlentities($username));
        $stmt->execute();
        $tester = 0;
		foreach ($stmt as $row)
		{
			$tester = 1;
			if(password_verify($password, $row["passwort"]))
			{
				if ($row["status"] == 1)
				{
					session_regenerate_id();
					$_SESSION["username"] = $row['username'];
					$_SESSION["email"] = $row['email'];
					return true;
				}
				else 
				{
					echo '<div class="alert alert-info" role="alert">Sie müssen zuerst Ihre Email bestätigen, bevor Sie sich einloggen können!</div>';
					return false;
				}
			}
			else 
			{
				echo '<div class="alert alert-danger" role="alert">Falsche Benutzerdaten!</div>';
				return false;
			}
		}
        if ($tester == 0)
        {
        	echo '<div class="alert alert-danger" role="alert">Falsche Benutzerdaten!</div>';
        	return false;
        }

    }
}
