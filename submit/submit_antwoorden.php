<?php
require "database.php";
save();


function getAvgVraag(string $naam){
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

function save(){
  $email = $_POST["email"];
  checkmail($email);
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

  $linkform = "localhost/stem/index.php";
      
  $conn = db();
 $date = date("Y-m-d");
  $qry = "INSERT INTO `antwoorden` (`ID`, `email`, `sbi`, `functie`, `organisatienaam`, `telefoonnummer`, `strategisch`, `organisatie`, `cultuur`, `daadkracht`, `marktintroductie`, `invuldatum`) VALUES (NULL, '$email', '$sbi', '$functie','$naamorganisatie', '$telefoonnummer','$strategisch', '$organisatie', '$cultuur', '$daadkracht', '$marktintroductie', '$date')";
  if ($conn->query($qry) === TRUE) {
      echo "Uw reactie is succesvol binnengekomen!";
      
    } else {
      echo "Error: " . $qry . "<br>" . $conn->error;
    }
    $conn->close();
}
function genereerlink(){
  $bedrijf_naam = $_POST["naamorganisatie"];
  return(''.$linkform.'?bedrijf='.base64_encode($bedrijf_naam).'');
}
function checkmail(string $mail){
  $conn = db();
  $sql = 'SELECT invuldatum FROM antwoorden where email = "'.$mail.'" ORDER BY invuldatum DESC LIMIT 1';
  $result = $conn->query($sql);
  //eerst kijken of er een eerdere reactie is, zo niet gewoon doorgaan met opslaan. zo wel kijken hoelang geleden. 
  if($result === TRUE){
    $strdate = $result->fetch_assoc()["invuldatum"];
    $date = new DateTime($strdate);
    $datenow = date_create();
    $verschil = $date->diff($datenow);
    $maanden = $verschil->y * 12 + $verschil->m;
    if ($maanden < 6){
      exit("reactie niet opgeslagen, er is in de laatste 6 maanden al een invulling met dit e-mail adres");
    }
  }
}
?>