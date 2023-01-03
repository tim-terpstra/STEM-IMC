<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.html');
    exit;
}
require "submit/database.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM categorie aanpassen </title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
    <?php
    if(array_key_exists('keyword', $_GET)) {
        $keyword = $_GET["keyword"];
        
        $conn = db();
        
        $sql = 'SELECT * FROM categorien WHERE keyword = "'.$keyword.'"';
        $result = $conn->query($sql);
    }
    while($row = $result->fetch_assoc()) {
        echo'
        <div id="formdiv">
        <form id="categorieform" action="submit/submit_verander_categorie.php" method="POST">
        <div class="mdl-textfield mdl-js-textfield">
        <textarea name="text_categorie" maxlength="250" class="mdl-textfield__input" type="text" form="categorieform" rows= "3" id="text_categorie" REQUIRED>'.utf8_encode($row["text_categorie"]).'</textarea>
        <label class="mdl-textfield__label" for="text_categorie"></label>
        </div></br>
        ';
    }
    $conn = db(); 
    $sql = 'SELECT MAX(nummer_volgorde) as nummer, nummer_volgorde from categorien';
    $result = $conn->query($sql);
    while($row = $result->fetch_assoc()) {
        $arr[] = $row["nummer"];
    }
    $hoogste_nummer = $arr[0] + 1;

    $origpos = $_GET["origpos"];
    echo'
    <label for="positie">positie van de categorie:</label>
    <div id="dropdiv">
    <select id="dropdown" name="positie">';
    for($i=1;$i<$hoogste_nummer;$i++){
        if($origpos == $i){
            echo'<option class="dropitems" selected value="'.$i.'">'.$i.'</option>';
        }else{
            echo'<option class="dropitems"value="'.$i.'">'.$i.'</option>';
        }
    }
    echo'
    </select>
    </div>
    </br>
    <input type="hidden" value="'.$keyword.'" name="keyword" />
    <input type="hidden" value="'.$origpos.'" name="origpos" />
    <input type="submit" value="Aanpassing doorvoeren" name="submit" id="toevoegen">
    </div>
    </form>';
    ?>
</body>
</html>
<style>
    #dropdiv{
  border-radius:36px;
  display:inline-block;
  overflow:hidden;
  background: rgb(63,81,181);
  border:2px solid rgb(63,81,181);
  box-shadow: 0 1px 2px black;
  margin-bottom: 5px;
  margin-top: 7px;
  }
  #dropdown{
  height: 38px;
  width:128px;
  color:white;
  background: rgb(63,81,181);
  border: solid rgb(63,81,181);
}
#toevoegen{
  background-color: rgb(63,81,181);
  border: 1px solid rgb(63,81,181);
  border-radius: 2px;
  width: 170px;
  height: 34px;
  color:white;
  box-shadow: 0 1px 2px black;
}
#formdiv{
    margin:auto;
    width:30%;
    margin-top:3px;
    
  }
</style>