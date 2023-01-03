<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>STEM InnovatieTest</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </head>
  <body>
    <?php
    require "submit/database.php";
    if(array_key_exists('bedrijf', $_GET)) {
    echo'<h4>Je vult de innovatiescan in voor: '.base64_decode($_GET["bedrijf"]).'</h4>';
    }
    ?>
    <div class="center">
      <form method="POST" action="submit/submit_antwoorden.php">
        <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
          <input class="mdl-textfield__input" type="text" id="email" name="email" required>
          <label class="mdl-textfield__label">E-Mail adress</label>
        </div>
              <?php
                    $i = 1;
                    $resultcat = getcat(); 
                    if ($resultcat !== NULL && $resultcat->num_rows > 0){
                      while($rowcat = $resultcat->fetch_assoc()) {
                        $result = textget($rowcat["keyword"]);
                        echo
                        '<div class="vraag_groep">
                        <h3>'.$i. '. ' .utf8_encode($rowcat["text_categorie"]).'</h3></br>
                        <div class="radio_value">
                        <text>Helemaal niet van toepassing</text>
                        <text>Deels niet van toepassing</text>
                        <text>Neutraal</text>
                        <text>Deels van toepassing</text>
                        <text>helemaal van toepassing</text>
                        </div>'
                        ;
                        // dit is categorie level 
                        if ($result !== NULL && $result->num_rows > 0) {
                        $ii = 1;
                        while($row = $result->fetch_assoc()) {
                          //dit is vraag level
                          echo '<div class="radios">';
                          echo '<div class="vragen">';
                          echo '<text>'.utf8_encode($row["text_vraag"]).'</text>
                          </div>';
                          
                          $score = 2;
                            for ($iii = 1; $iii <= 5; $iii++) {
                            echo '<label class="demo-list-radio mdl-radio mdl-js-radio mdl-js-ripple-effect" for="'.$rowcat["keyword"].'-option-'.$i.$ii.$iii.'">';
                            echo '<input type="radio" id="'.$rowcat["keyword"].'-option-'.$i.$ii.$iii.'" class="mdl-radio__button" name="'.$rowcat["keyword"].'_vraag'.$ii.'" value="'.$score.'" required/></label>';
                            
                            $score += 2;
                          }
                          echo "<div></div></div>";
                          $ii++;
                        }
                        $i++;
                        }
                        echo '</div>';
                        }
                      }
              ?>
              <div class="vraag_groep">
            <h3>Algemeen</h3>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                      <input class="mdl-textfield__input" type="text" id="naam" name="naam" required>
                                      <label class="mdl-textfield__label">Wat is uw naam?</label>
                                    </div></br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                      <input class="mdl-textfield__input" type="text" id="naamorganisatie" name="naamorganisatie" required>
                                      <label class="mdl-textfield__label">Wat is de naam van uw organisatie?</label>
                                    </div></br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                      <input class="mdl-textfield__input" type="text" id="sbi" name="sbi" required>
                                      <label class="mdl-textfield__label"> Wat is de SBI code van uw organisatie?<label>
                                    </div></br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                      <input class="mdl-textfield__input" type="text" id="functie" name="functie" required>
                                      <label class="mdl-textfield__label">Wat is uw functie?<label>
                                    </div></br>
                                    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                      <input class="mdl-textfield__input" type="tel" id="telefoonnummer" name="telefoonnummer" pattern="[0-9]{10,12}" required>
                                      <label class="mdl-textfield__label">Wat is uw telefoonnummer?</label>
                                    </div>
          </div>
          <input type="submit" value="Submit" name="submit">
        </div>
        </form>
    </div>
    <?php
function printdetailvragen(){
  echo'
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
              <input class="mdl-textfield__input" type="text" id="naam" name="naam" required>
              <label class="mdl-textfield__label">Wat is uw naam?</label>
              <!-- hier nog regex toevoegen met wat er in moet komen -->
            </div></br>
            ';

if(!array_key_exists('bedrijf', $_GET)) {
  echo'
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  <input class="mdl-textfield__input" type="text" id="naamorganisatie" name="naamorganisatie" required>
  <label class="mdl-textfield__label">Wat is de naam van uw organisatie?</label>
  </div></br>
  ';
  echo'
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  <input class="mdl-textfield__input" type="text" id="sbi" name="sbi" required>
  <label class="mdl-textfield__label"> Wat is de SBI code van uw organisatie?<label>
  </div></br>
  ';
  echo'
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
  <input class="mdl-textfield__input" type="tel" id="telefoonnummer" name="telefoonnummer" pattern="[0-9]{10,12}" required>
  <label class="mdl-textfield__label">Wat is uw telefoonnummer?</label>
  </div></br>
  ';
}
echo'
<div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
            <input class="mdl-textfield__input" type="text" id="functie" name="functie" required>
            <label class="mdl-textfield__label">Wat is uw functie?<label>
          </div></br>
';
}
  
function textget(string $catagorie){
    $conn = db();
    
    $sql = "SELECT text_vraag FROM vragen WHERE catagorie = '$catagorie' ORDER BY nummer_volgorde ASC";
    
    $result = $conn->query($sql);
    if ($result === FALSE) return null;
    return $result;
    }
    ?>
  </body>
</html>
<style>
  .center {
  margin: auto;
  width: 55%;
  padding: 10px;
  background-color:#fce9ef;
}
body{
  color: rgb(0, 0, 0, 0.7);
}
.radios{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom:25px;
  }
.radio_value{
  word-break:normal;
  padding-left: 30%;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
  text-align: center;
  padding-right:6%;
  margin-bottom:6px;
}
text{
  width:20%;
}
.vragen{
  height: min-content;
  width: 25%;
}
.vraag_groep{
  background-color: rgba(204, 204, 204, 0.28);
  border-radius: 8px;
  padding-bottom:1px;
}
.vraag_groep h3{
  padding-top:3px;
}
</style>