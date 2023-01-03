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
	$resultcat = getcat(); 
    if ($resultcat !== NULL && $resultcat->num_rows > 0){
	echo'<div class="wrapper">';
	while($rowcat = $resultcat->fetch_assoc()) {
		echo'<div class="catagorie">';
		echo'<h3><a href="verander-categorie.php?keyword='.$rowcat["keyword"].'&origpos='.$rowcat["nummer_volgorde"].'">'.utf8_encode($rowcat["text_categorie"]).' <i style="font-size:24px" class="material-icons">&#xe3c9;</a></i></h3>';
		$arr = textgetarray($rowcat["keyword"]);
		if ($arr !== NULL){
			foreach($arr as $textarr){
				echo $textarr["nummer_volgorde"]; 
				echo'
				'.utf8_encode($textarr["text_vraag"]).'
				<i style="font-size:24px" class="material-icons"><a href="verander-vraag.php?id='.$textarr["id"].'&categorie='.$textarr["catagorie"].'">&#xe3c9;</a></i></br>
			  ';
			}
		}
		echo '<a href="vraag-toevoegen.php?categorie='.$rowcat["keyword"].'"><b>voeg een nieuwe vraag toe!</b> <i class="material-icons">add_circle</i><a/>';
		echo '</div>';
	}
	echo'<a href="categorie-toevoegen.php"><b style="font-size:28px">voeg een nieuwe categorie toe!</b><i style="font-size:34px"class="material-icons">add_circle</i><a/>';
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