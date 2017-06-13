<!Doctype>
<html>
<head>
	<title>My Login Page</title>
</head>
<body>
	<h1>Registrierung</h1>
	<form method="POST">
		<label>
			Username:
			<input type="username" name="username" value="<?= (isset($username)) ? $username: "" ?>"/>
		</label>
		<label>
			Email:
			<input type="email" name="email" value="<?= (isset($email)) ? $email: "" ?>"/>
		</label>
		<label>
			Passwort:
			<input type="password" name="password" />
		</label>
		<label>
			Passwort wiederholen:
			<input type="password" name="passwordRepeat" />
		</label>
		<input type="submit" name="registrieren" value="Registrieren" />
	
	</form>
</body>
</html>