<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != '') {

    header ("Location: members.php");
    
}
$_SESSION['errorMessage'] = "";
$errorMsg = "";
if(isset($_POST["sub"])) {
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

    $sql = "SELECT username, password FROM user where username = '".$_POST['username']. "' and password = '".$_POST['password']. "'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $_SESSION['username'] = $_POST['username'];
        header ("Location: members.php");
    } else {
        $errorMsg = "Credenciales erróneas";
    }
    $conn->close();
}
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Login</title>
</head>
<body>
    <h1>LOGIN PAGE</h1>
  <form name="login" action="#" method="POST">
    <label for="username">Username:</label><input type="text" value="<?= $_POST["username"] ?>" id="username" name="username" />
    <label for="password">Password:</label><input type="password" value="" id="password" name="password" />
    <div class="error"><?= $errorMsg ?></div>
    <br/>
    <input type="submit" value="Login" name="sub" />
  </form>
</body>
</html>