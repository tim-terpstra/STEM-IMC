<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<html>
	<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>STEM Dashboard</title>
		<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	</head>
	<body>
		<div id="button-div">
			<button onclick="location.href='logout.php'" id="uitloggen" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
				Uitloggen
			</button>
<button id="aanpassen" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
	Vraag toevoegen
</button>
<button id="aanpassen" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
  Vragen aanpassen
</button>
</div>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "stem";
$conn = new mysqli($servername, $username, $password, $database);
$sql = 'SELECT organisatienaam,sbi, functie, telefoonnummer, strategisch, organisatie, daadkracht, cultuur, marktintroductie FROM antwoorden WHERE telefoonnummer IS NOT NULL AND TRIM(telefoonnummer) <> "" ORDER BY id DESC';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo'
	<div style="overflow-x:auto;" id="table-div";>
	<table id="table"class="mdl-data-table mdl-js-data-table mdl-shadow--2dp"><tr><th class="mdl-data-table__cell--non-numeric">Organisatie</th><th>SBI</th><th>Telefoonnummer:</th><th>Functie:</th><th>Strategisch</th><th>Organisatie</th><th>Daadkracht</th><th>Cultuur</th><th>Marktintroductie</th></tr>
	</div>';
	//print de data van elke rij
	while($row = $result->fetch_assoc()) {
	  echo "<tr><td class='mdl-data-table__cell--non-numeric'>".$row["organisatienaam"]."</td><td>".$row["sbi"]."</td><td>".$row["telefoonnummer"]."</td><td>".$row["functie"]."</td><td>".$row["strategisch"]."</td><td>".$row["organisatie"]."</td><td>".$row["daadkracht"]."</td><td>".$row["cultuur"]."</td><td>".$row["marktintroductie"]."</td></tr>";
	}
	echo "</table>";
  } else{
	echo "Tabel is leeg";
  }
  ?>
<style>
 #button-div{
	 width: 100%;
}
button{
	margin-left:5px !important;
}
button{
	float:right;
}
 table{
	width: 100%;
  }
#table-div{
	float:right;
	width:100%;	
	height: 50%; 
	margin-top: 20%;
  }
  </style>
<?php
  $conn->close();
?>
</body>
</html>