<?php 
session_start();
 $servername = "localhost";
 $username = "root";
 $password = "";
 $database = "stem";

 $con = new mysqli($servername, $username, $password, $database);
 if ($con->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }
   //geinspireerd door: "https://codeshack.io/secure-login-system-php-mysql/"
   if ( !isset($_POST['gebruiker'], $_POST['wachtwoord']) ) {
	//data is niet ingevuld.
	exit('alle 2 de velden invullen alstublieft!');
    

   }
   if ($stmt = $con->prepare('SELECT id, password FROM gebruikers WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['gebruiker']);
	$stmt->execute();
	$stmt->store_result();

    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
    
        if (password_verify($_POST['wachtwoord'], $password)) {
            //verificatie is gelukt, maak een sessie die aangeeft dat de gebruiker is ingelogd 
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['gebruiker'];
            $_SESSION['id'] = $id;
            //stuur door naar de homepage dus het dashboard met linkje naar de veranderpagina.
            header('Location: dashboard.php');
        } else {
            //verkeerd wachtwoord
            echo 'incorrecte gebruiker en/of wachtwoord!';
        }
    } else {
        // verkeerde naam
        echo 'incorrecte gebruiker en/of wachtwoord!';
    }
    $stmt->close();
}
?>