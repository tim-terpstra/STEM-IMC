<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>STEM gebruiker toevoegen</title>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	</head>
<body>
	<div id="formdiv">
		<form action="submit/submit_gebruiker.php" class="gebruiker toevoegen" method="POST">
			
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="text" id="username" name="username" required>
				<label class="mdl-textfield__label" for="username">gebruikersnaam</label>
			</div>
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" id="password" name="password" required>
				<label class="mdl-textfield__label" for="password">Wachtwoord</label>
			</div>
			
			<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
				<input class="mdl-textfield__input" type="password" id="confirm_password" name="confirm_password" required>
				<label class="mdl-textfield__label" for="confirm_password">Verifieer uw wachtwoord</label>
			</div></br>
			<input type="submit" value="Toevoegen" name="Toevoegen" id="toevoegen">
		</form>
	</div>
</body>
</html>
<script>
	var password = document.getElementById("password");
	var confirm_password = document.getElementById("confirm_password");

	function checkpassword(){
  if(password.value != confirm_password.value) {
	  confirm_password.setCustomValidity("Wachtwoorden komen niet overeen!");
	} else {
	confirm_password.setCustomValidity('');
  }
}

password.onchange = checkpassword;
confirm_password.onkeyup = checkpassword;
</script>
<style>
	#formdiv{
  text-align: center;
    margin:auto;
    width:30%;
    margin-top:3%;
  }
	#toevoegen{
  background-color: rgb(63,81,181);
  border: 1px solid rgb(63,81,181);
  border-radius: 2px;
  width: 90px;
  height: 34px;
  color:white;
  box-shadow: 0 1px 2px black;
}
</style>