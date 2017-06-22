<!Doctype>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" href="stylesheets/stylesheet.css">
	<!-- Import Ajax From Google Servers -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!---------------------------------------------------------------------------------------->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
<?php 
if (isset($_SESSION["username"]))
{
	echo "<h1><center>Sie sind bereits eingeloggt</br></br><a href='/'>Zurück zur Seite</a></center></h1>";
}
else 
{
?>
<div class="login">
	<h1>Login</h1>
	<form method="POST">
		<label>
			<input type="text" name="email" value="<?= (isset($email)) ? $email: "" ?>" class="form-control" placeholder="Email oder Username"/>
		</label>
		</br>
		<label>
			<input type="password" name="password" class="form-control" placeholder="Passwort"/>
		</label>
		<input type="hidden" name="CSRF" value="<?php echo getCSRF();?>">
		</br>
		<input type="submit" name="login" value="Login" class="btn btn-default"/>
	</form>
	<a href="/newPassword"><button class="btn btn-default">Passwort vergessen</button></a></br>
	<a href="/registrieren">zum Registrieren</a></br>
	<a href="/">zurück zur Startseite</a>
</div>
<?php 
}
function getCSRF()
{
	$link = "";
	$zeichen = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z',
			'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z', '!', '$', '?',
			'1', '2', '3', '4', '5', '6', '7,' ,'8', '9');
	for ($i = 0; $i < 25; $i++)
	{
		$randomNumber =  rand(0, count($zeichen));
		$link = $link . $zeichen[$randomNumber];
	}
	$_SESSION['CSRF'] = $link;
	return $link;
}
?>
</body>
</html>