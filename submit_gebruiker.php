<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}

var_dump($_POST);
if(array_key_exists('username', $_POST)) {
  db();
}

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
    $gebruiker = $_POST["gebruiker"];
    $qry = "DELETE FROM gebruikers WHERE username = '".$gebruiker."'";
    if ($conn->query($qry) === TRUE) {
      echo "Gebruiker is verwijderd!";
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
}

function db(){
$gebruiker = $_POST["username"];
$wachtwoord = $_POST["password"]; 

$servername = "localhost";
$username = "root";
$password = "";
$database = "stem";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
echo 1;
$hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
//TODO convert wachtwoord naar gehashed ww
  $qry = "INSERT INTO `gebruikers` (`ID`,`username`, `password`) VALUES (NULL, '$gebruiker', '$hashed_wachtwoord')";
  if ($conn->query($qry) === TRUE) {
      echo "Gebruiker is toegevoegd!";
      echo'
      <form method ="POST">
      <input type="hidden" value="'.$gebruiker.'" name="gebruiker" />
      <input type="submit" name="ongedaan" class="button" value ="Ongedaan maken">
        </form>
        ';
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
    
    $conn->close();
}