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

    $sql = "INSERT INTO class_group (name, carne) values('".$_POST['name']. "', '".$_POST['carne']. "')";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['errorMessage'] = "Miembro ingresado exitosamente.";
        header ("Location: members.php");
    } else {
        $_SESSION['errorMessage'] = "Ha ocurrido un error interno.";
        header ("Location: members.php");
    }
    $conn->close();
} else {
    $_SESSION['errorMessage'] = "Por favor ingrese nombre y carné";
    header ("Location: members.php");
}

?>