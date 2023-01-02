<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
require "database.php";
var_dump($_POST);
if(array_key_exists('username', $_POST)) {
  save();
}

if(array_key_exists('ongedaan', $_POST)) {
  undo();}


function undo(){
  $conn = db();
    $gebruiker = $_POST["gebruiker"];
    $qry = "DELETE FROM gebruikers WHERE username = '".$gebruiker."'";
    if ($conn->query($qry) === TRUE) {
      echo "Gebruiker is verwijderd!";
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
}

function save(){
$gebruiker = $_POST["username"];
$wachtwoord = $_POST["password"]; 

$conn = db();
$hashed_wachtwoord = password_hash($wachtwoord, PASSWORD_BCRYPT);
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