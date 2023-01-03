<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
require "database.php";

if(array_key_exists('text', $_POST)) {
    save();}

if(array_key_exists('ongedaan', $_POST)) {
    undo();} 

function undo(){
    $conn = db();
    $keyword = $_POST["keyword"]; 
    $qry = "DELETE FROM categorien WHERE keyword = '".$keyword."'";
    if ($conn->query($qry) === TRUE) {
    echo "Categorie is verwijderd!";
    } else {
    echo "Error: " . $qry . "<br>" . $conn->error;
    }
}

function save(){
    $conn = db(); 
    $sql = 'SELECT MAX(nummer_volgorde) as nummer from categorien';
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $arr[] = $row["nummer"];
    }
    $hoogste_nummer = $arr[0] + 1;
    $text = $_POST["text"];
    $keyword = $_POST["keyword"]; 
        $conn = db();
        $sql = "INSERT INTO `categorien` (`keyword`, `text_categorie`, `nummer_volgorde`) VALUES ('$keyword','$text','$hoogste_nummer')";
        if ($conn->query($sql) === TRUE) {
            echo "Categorie is toegevoegd!";
            echo'
            <form method ="POST">
            <input type="hidden" value="'.$keyword.'" name="keyword" />
            <input type="submit" name="ongedaan" class="button" value ="Ongedaan maken">
              </form>
              ';
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
}
?>