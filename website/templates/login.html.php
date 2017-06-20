<!Doctype>
<html>
<head>
	<title>My Login Page</title>
	<link rel="stylesheet" href="stylesheets/stylesheet.css">
</head>
<body class="blue">
	<h1>Login</h1>
	<form method="POST">
		<label>
			Email:
			<input type="text" name="email" value="<?= (isset($email)) ? $email: "" ?>"/>
		</label>
		<label>
			Passwort:
			<input type="password" name="password" />
		</label>
		<input type="submit" name="login" value="Login" />
	
	</form>
</body>
</html>