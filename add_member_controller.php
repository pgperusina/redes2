<?php
session_start();
if (!(isset($_SESSION['username'])) && $_SESSION['username'] == '') {

    header ("Location: login.php");
    
}

$_SESSION['errorMessage'] = "";
if ( isset($_POST["sub"]) && isset($_POST["carne"]) && isset($_POST["name"])) {
    $servername = "database-server";
    $username = "root";
    $password = "";
    $dbname = "redes2grupo4";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "SELECT name, carne FROM class_group where name = ".$_POST['name']. " and carne = ".$_POST['carne'];
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        header ("Location: members.php");
    } else {
        $errorMsg = "Credenciales erróneas";
    }
    $conn->close();
} else {
    $_SESSION['errorMessage'] = "Por favor ingrese nombre y carné";
}


$servername = "database-server";
$username = "root";
$password = "";
$dbname = "redes2grupo4";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT name, carne FROM class_group";
$result = $conn->query($sql);
?>