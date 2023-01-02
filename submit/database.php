
<?php 
function db(){
    static $conn;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "stem";
    if($conn === NULL){
        $conn = new mysqli($servername, $username, $password, $database);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    }
    return $conn;
}
?>