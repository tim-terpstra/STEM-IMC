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
      <div id="formdiv">
      <p>In welke categorie valt de vraag?</p>
      <form id="vraagform" action="submit_vraag.php" method="POST">
      <div id="dropdiv">
      <label class="" for="categorie"></label>
        <select id="dropdown" name="categorie" id="categorie">
        ';

      while($row = $result->fetch_assoc()) {
        echo'<option class="dropitems" value="'.strtoupper($row["catagorie"]).'">'.strtoupper($row["catagorie"]).'</option>';
      }
      echo'</select></div></br></br>';
      echo'
        <hr>
        <p>Wat is de tekst van de vraag?</p>
        <div class="mdl-textfield mdl-js-textfield">
        <textarea name="text_vraag" maxlength="250" class="mdl-textfield__input" type="text" form="vraagform"rows= "2" id="text_vraag" REQUIRED ></textarea>
        <label class="mdl-textfield__label" for="text_vraag">Text van de vraag</label>
        </div>
        </br>
        <input id="toevoegen" type="submit" value="Toevoegen" name="submit">
        </form>
        </div>
      ';

  }else{
    echo"error";
  } 
?>
</body>
</html>
<style>
  #formdiv{
    margin:auto;
    width:30%;
    margin-top:3%;
    
  }
  #dropdiv{
  border-radius:36px;
  display:inline-block;
  overflow:hidden;
  background: rgb(63,81,181);
  border:2px solid rgb(63,81,181);
  box-shadow: 0 1px 2px black;
  }
  #dropdown{
  color:white;
  background: rgb(63,81,181);
  width:128px;
  height: 38px;
  border: solid rgb(63,81,181);
}
.dropitems{
  border:0px;
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