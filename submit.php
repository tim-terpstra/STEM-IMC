<?php
$email = $_POST["email"];
$naam = $_POST["naam"]; 
$naamorganisatie = $_POST["naamorganisatie"];
$sbi = $_POST["sbi"];
$functie = $_POST["functie"];
$telefoonnummer = $_POST["telefoonnummer"];

$strategisch = getAvgVraag("strategisch_vraag");
$organisatie = getAvgVraag("organisatie_vraag");
$cultuur = getAvgVraag("cultuur_vraag");
$daadkracht = getAvgVraag("daadkracht_vraag");
$marktintroductie = getAvgVraag("marktintroductie_vraag");

$arr = array($strategisch,$organisatie,$cultuur,$daadkracht,$marktintroductie,$naam, $naamorganisatie,$sbi,$functie,$telefoonnummer,$email);
foreach($arr as $item){
    echo $item;
}
db();


function getAvgVraag(string $naam){
  //hier dan een naam inserten en met die naam 10 keer loopen dan een array terug geven.
  $arr = array();
  for($i = 1; $i <= 15; $i++){
    if (isset($_POST[$naam.$i])){
      $value = $_POST[$naam.$i];
    }else{
      return array_sum($arr)/count($arr);
    }
    array_push($arr, intval($value));  
  }
  return array_sum($arr)/count($arr);
}

function db(){

  $email = $_POST["email"];
  $naam = $_POST["naam"]; 
  $naamorganisatie = $_POST["naamorganisatie"];
  $sbi = $_POST["sbi"];
  $functie = $_POST["functie"];
  $telefoonnummer = $_POST["telefoonnummer"];

  $strategisch = getAvgVraag("strategisch_vraag");
  $organisatie = getAvgVraag("organisatie_vraag");
  $cultuur = getAvgVraag("cultuur_vraag");
  $daadkracht = getAvgVraag("daadkracht_vraag");
  $marktintroductie = getAvgVraag("marktintroductie_vraag");

  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "stem";
  $table = "vragen";
  
  //verdeel dit in functies
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);
  
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
  $qry = "INSERT INTO `antwoorden` (`ID`, `email`, `sbi`, `functie`, `organisatienaam`, `telefoonnummer`, `koppelcode`, `strategisch`, `organisatie`, `cultuur`, `daadkracht`, `marktintroductie`) VALUES (NULL, '$email', '$sbi', '$functie','$naamorganisatie', '10', 'f', '$strategisch', '$organisatie', '$cultuur', '$daadkracht', '$marktintroductie')";
  if ($conn->query($qry) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>