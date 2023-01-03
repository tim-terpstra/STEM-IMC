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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM categorie toevoegen</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>  
</head>
<body>
    
</body>
</html>
<div id="formdiv">
<form id="vraagform" action="submit/submit_categorie.php" method="POST">
    <p>wat is de tekst van de categorie?</p>
    <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="text" id="text" name="text" for="text" required>
        <label class="mdl-textfield__label"></label>
    </div>
    <p>wat is het sleutelwoord van de categorie?</p>
    <div class="mdl-textfield mdl-js-textfield">
        <input class="mdl-textfield__input" type="text" id="keyword" name="keyword" for="keyword" required>
        <label class="mdl-textfield__label"></label>
    </div>
    </br>
    <input id="toevoegen" type="submit" value="Toevoegen" name="submit">
</div>

</form>
</html>
<style>
  #formdiv{
    margin:auto;
    width:30%;
    margin-top:3px;
    
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