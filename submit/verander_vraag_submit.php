<?php
require "database.php";
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: ../login.html');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>submit vraag verandering</title>
</head>
<body>
    <?php
    $text = $_POST["text_vraag"];
    $gopos = $_POST["positie"];
    $id = $_POST["id"];
    $categorie = $_POST["categorie"];
    $origpos = $_POST["origpos"];

    $conn = db();

    if($origpos > $gopos){
        $sql = 'SELECT * FROM vragen WHERE catagorie = "'.$categorie.'" AND nummer_volgorde BETWEEN "'.$gopos.'" AND "'.$origpos.'" AND NOT nummer_volgorde = "'.$origpos.'" ORDER BY nummer_volgorde DESC';
        massposupdate($sql,1);
        $sql ='UPDATE vragen SET nummer_volgorde = "'.$gopos.'" WHERE id = "'.$id.'"';
        if(!$conn->query($sql)){
            die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Posupdate");
            }
        }elseif($origpos < $gopos){
            $sql = 'SELECT * FROM vragen WHERE catagorie = "'.$categorie.'" AND nummer_volgorde BETWEEN "'.$origpos.'" AND "'.$gopos.'" AND NOT nummer_volgorde = "'.$origpos.'" ORDER BY nummer_volgorde ASC';
            massposupdate($sql, -1);
            $sql ='UPDATE vragen SET nummer_volgorde = "'.$gopos.'" WHERE id = "'.$id.'"';
            if(!$conn->query($sql)){
                die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Posupdate");
            }
        }
    
    $sql = 'UPDATE vragen SET text_vraag = "'.$text.'" WHERE id = "'.$id.'"';
    if(!$conn->query($sql)){
        die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Textupdate");
    }

    header('Location: ../vraag-lijst.php');
    function massposupdate(string $sql, int $richting){
        $conn = db();

        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $sql = 'UPDATE vragen SET nummer_volgorde = "'.$row["nummer_volgorde"] + $richting.'" WHERE id="'.$row["ID"].'"';
            $success = $conn->query($sql);
            if(!$success){
                die("Er is iets verkeerd gegaan, neem contact op met een administrator om het probleem op te lossen.</br> error code:Sequanceupdate");
            }
        }
    }
    ?>
</body>
</html>