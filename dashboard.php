<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$servername = "localhost";
$username = "root";
$password = "";
$database = "stem";
$conn = new mysqli($servername, $username, $password, $database);
$sql = 'SELECT organisatienaam,sbi, functie, telefoonnummer, strategisch, organisatie, daadkracht, cultuur, marktintroductie FROM vragen WHERE telefoonnummer IS NOT NULL AND TRIM(telefoonnummer) <> ""';
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	echo'
	<div style="overflow-x:auto;" id="table-div";>
	<table id="table"><tr><th>Organisatie</th><th>SBI</th><th>Telefoonnummer:</th><th>Functie:</th><th>Strategisch</th><th>Organisatie</th><th>Daadkracht</th><th>Cultuur</th><th>Marktintroductie</th></tr>
	</div>';
	//print de data van elke rij
	while($row = $result->fetch_assoc()) {
	  echo "<tr><td>".$row["organisatienaam"]."</td><td>".$row["sbi"]."</td><td>".$row["telefoonnummer"]."</td><td>".$row["functie"]."</td><td>".$row["strategisch"]."</td><td>".$row["organisatie"]."</td><td>".$row["daadkracht"]."</td><td>".$row["cultuur"]."</td><td>".$row["marktintroductie"]."</td></tr>";
	}
	echo "</table>";
  } else{
	echo "Tabel is leeg";
  }
  ?>
<style>
*{
	font-size: 0.8vw;
}
td{
	text-align:center;
}

table{
	/* text-align: left; */
	width: 100%;
	table-layout:fixed;
  }
#table-div{	
	height: 50%; 
	margin-top: 20%;
  }
  tr:nth-child(even){
	background-color:rgb(212, 212, 212);
}
  </style>
<?php
  $conn->close();
?>