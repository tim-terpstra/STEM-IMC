<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
require "database.php";

$text = $_POST["text_categorie"];
$gopos = $_POST["positie"];
$keyword = $_POST["keyword"];
$origpos = $_POST["origpos"];

$conn = db();

if($origpos > $gopos){
    $sql = 'SELECT * FROM categorien WHERE nummer_volgorde BETWEEN "'.$gopos.'" AND "'.$origpos.'" AND NOT nummer_volgorde = "'.$origpos.'" ORDER BY nummer_volgorde DESC';
    massposupdate($sql,1);
    $sql ='UPDATE categorien SET nummer_volgorde = "'.$gopos.'" WHERE keyword = "'.$keyword.'"';
    if(!$conn->query($sql)){
        die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Posupdate");
        }
    }elseif($origpos < $gopos){
        $sql = 'SELECT * FROM categorien WHERE nummer_volgorde BETWEEN "'.$origpos.'" AND "'.$gopos.'" AND NOT nummer_volgorde = "'.$origpos.'" ORDER BY nummer_volgorde ASC';
        massposupdate($sql, -1);
        $sql ='UPDATE categorien SET nummer_volgorde = "'.$gopos.'" WHERE keyword = "'.$keyword.'"';
        if(!$conn->query($sql)){
            die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Posupdate");
        }
    }

$sql = 'UPDATE categorien SET text_categorie = "'.$text.'" WHERE keyword = "'.$keyword.'"';
if(!$conn->query($sql)){
    die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Textupdate");
}

header('Location: ../vraag-lijst.php');
function massposupdate(string $sql, int $richting){
    $conn = db();

    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $sql = 'UPDATE categorien SET nummer_volgorde = "'.$row["nummer_volgorde"] + $richting.'" WHERE keyword="'.$row["keyword"].'"';
        $success = $conn->query($sql);
        if(!$success){
            die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Sequanceupdate");
        }
    }
}
?>