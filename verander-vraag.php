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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM vraag aanpassen </title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
    <?php
    if(array_key_exists('id', $_GET)) {
    $id = $_GET["id"];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "stem";
    
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = 'SELECT text_vraag, catagorie ,nummer_volgorde FROM vragen WHERE id = "'.$id.'"';
    $result = $conn->query($sql);

    
    
    while($row = $result->fetch_assoc()) {
        echo'
        <form id="vraagform" action="verander_vraag_submit.php" method="POST">
        <div class="mdl-textfield mdl-js-textfield">
        <textarea name="text_vraag" maxlength="250" class="mdl-textfield__input" type="text" form="vraagform"rows= "4" id="text_vraag" REQUIRED>'.utf8_encode($row["text_vraag"]).'</textarea>
        <label class="mdl-textfield__label" for="text_vraag"></label>
        </div></br>
        ';
        $sql = 'SELECT MAX(nummer_volgorde) as nummer from vragen WHERE catagorie = "'.$row["catagorie"].'"';
        $result_hoogste_nummer = $conn->query($sql);
        $hoogste_nummer = $result_hoogste_nummer->fetch_assoc()["nummer"];
        $hoogste_nummer++;
        echo'
        <label for="positie">positie van de vraag:</label>
        <select name="positie">';
        for($i=1;$i<$hoogste_nummer;$i++){
            if($row["nummer_volgorde"] == $i){
                echo'<option selected value="'.$i.'">'.$i.'</option>';
            }else{
                echo'<option value="'.$i.'">'.$i.'</option>';
            }
        }
        echo'
        </select>
        </br>
        <input type="hidden" value="'.$id.'" name="id" />
        <input type="hidden" value="'.$row["catagorie"].'" name="categorie" />
        <input type="hidden" value="'.$row["nummer_volgorde"].'" name="origpos" />
		<input type="submit" value="Aanpassing doorvoeren" name="submit" id="toevoegen">
        </form>';
    }

}else {
    echo"Er is een fout voorgekomen!";
}
    ?>
</body>
</html>