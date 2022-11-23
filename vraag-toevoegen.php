<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM InnovatieTest</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </head>
  <body>
<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "stem";
$conn = new mysqli($servername, $username, $password, $database);
$sql = 'SELECT DISTINCT catagorie FROM `vragen`';
$result = $conn->query($sql);

if ($result->num_rows > 0){
      echo'
      <form id="vraagform" action="submit_vraag.php" method="POST">
      <label class="mdl-textfield__label" for="categorie"></label>
        <select name="categorie" id="categorie">
        ';

      while($row = $result->fetch_assoc()) {
        echo'<option value="'.$row["catagorie"].'">'.$row["catagorie"].'</option>';
      }
      echo'</select>';
      echo'
        </br>
        </br>
        <div class="mdl-textfield mdl-js-textfield">
        <textarea name="text_vraag" maxlength="250" class="mdl-textfield__input" type="text" form="vraagform"rows= "3" id="text_vraag" REQUIRED ></textarea>
        <label class="mdl-textfield__label" for="text_vraag">Text van de vraag</label>
        </div>
        <input type="submit" value="Toevoegen" name="submit">
        </form>
      ';

  }else{
    echo"error";
  } 
?>
</body>
</html>