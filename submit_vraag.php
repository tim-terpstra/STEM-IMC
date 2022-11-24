<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}

//$categorie = $_POST["categorie"];
//$text = $_POST["text_vraag"]; 
if(array_key_exists('text_vraag', $_POST)) {
  db();;}

if(array_key_exists('ongedaan', $_POST)) {
  undo();}


function undo(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "stem";
  $conn = new mysqli($servername, $username, $password, $database);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
    $categorie = $_POST["categorie"]; 
    $nummer = $_POST["volgorde"];
    $qry = "DELETE FROM vragen WHERE catagorie = '".$categorie."' AND nummer_volgorde = ".$nummer."";
    if ($conn->query($qry) === TRUE) {
      echo "Vraag is verwijderd!";
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
}

function db(){
$categorie = $_POST["categorie"];
$text = $_POST["text_vraag"]; 

$servername = "localhost";
$username = "root";
$password = "";
$database = "stem";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

$sql = 'SELECT MAX(nummer_volgorde) as nummer from vragen WHERE catagorie = "'.$categorie.'"';
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $arr[] = $row["nummer"];
}
$nummer_volgorde = $arr[0] + 1;

  $qry = "INSERT INTO `vragen` (`ID`, `catagorie`, `nummer_volgorde`, `text_vraag`) VALUES (NULL, '$categorie', '$nummer_volgorde', '$text')";
  if ($conn->query($qry) === TRUE) {
      echo "Vraag is toegevoegd!";
      echo'
      <form method ="POST">
      <input type="hidden" value="'.$categorie.'" name="categorie" />
      <input type="hidden" value="'.$nummer_volgorde.'" name="volgorde" />
      <input type="submit" name="ongedaan" class="button" value ="Ongedaan maken">
        </form>
        ';
	  //todo een ctrl z als het ware toevoegen.
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
    
    $conn->close();
}