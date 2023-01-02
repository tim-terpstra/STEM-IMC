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
		<title>STEM vragen varanderen</title>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
		<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	</head>
<body>
	<?php
	$catagorien = array(
		"strategisch" => "1. STRATEGISCHE aspecten bij innovaties",
		"organisatie" => "2. ORGANISATORISCHE aspecten bij innovaties",
		"cultuur" => "3. CULTURELE aspecten bij innovatie",
		"daadkracht" => "4. Innovatie DAADKRACHT aspecten",
		"marktintroductie" => "5. MARKTINTRODUCTIE aspecten bij innovatie",
	);
	echo'<div class="wrapper">';
	foreach($catagorien as $k => $val){
		echo'<div class="catagorie">';
		echo'<h3>'.utf8_encode($val).' <i style="font-size:24px" class="material-icons"><a href="">&#xe3c9;</a></i></h3>';
		$arr = textgetarray($k);
		if ($arr->num_rows > 0){
			foreach($arr as $textarr){
				echo $textarr["nummer_volgorde"]; 
				echo'
				'.utf8_encode($textarr["text_vraag"]).'
				<i style="font-size:24px" class="material-icons"><a href="verander-vraag.php?id='.$textarr["id"].'&categorie='.$textarr["catagorie"].'">&#xe3c9;</a></i></br>
			  ';
			}
		}
		echo '<a href="vraag-toevoegen.php?categorie='.$k.'"><b>voeg een nieuwe vraag toe!</b> <i class="material-icons">add_circle</i><a/>';
		echo '</div>';
	}
	echo'</div>';
	function textgetarray(string $catagorie){
		$conn = db();
		
		$sql = "SELECT id, catagorie,text_vraag, nummer_volgorde FROM vragen WHERE catagorie = '$catagorie' ORDER BY nummer_volgorde ASC";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()){
			$arr[$row["id"]] = $row["text_vraag"];
		}
		return $result;
		}
?>
</body>
</html>
<style>
	.mdl-textfield{
		width:37%;
	}
	a { 
	color: inherit; 
	text-decoration: none;
	} 
	.wrapper{
		padding-bottom: 30px;
		margin-left:auto;
		margin-right:auto;
		width:60%
	}
	.material-icons{
		vertical-align:  -7px;
	}
</style>