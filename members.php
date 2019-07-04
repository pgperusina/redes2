<?php
session_start();
if (!(isset($_SESSION['username'])) && $_SESSION['username'] == '') {

    header ("Location: login.php");
    
}

$errorMsg = $_SESSION['errorMessage'];

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
<!DOCTYPE html>
<html>

    <body>

        <h1>Redes de computadoras 2</h1>
        <h2>Proyecto final de laboratorio<h2>
                <table border="1">
                    <tr>
                        <th>Nombre</th>
                        <th>Carne</th>
                    </tr>
                    <?php
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr><td>".$row['name']."</td><td>".$row['carne']."</td></tr>";
                            }
                        } else {
                            echo "No results";
                        }
                        $conn->close();
                    ?>
                </table>
                <br/>
                <br/>
                <h1>Agregar miembro</h1>
                <form name="add" action="add_member_controller.php" method="POST">
                    <label for="name">Nombre:</label><input type="text" value="<?= $_POST["name"] ?>" id="name" name="name" />
                    <label for="carne">Carne:</label><input type="password" value="" id="carne" name="carne" />
                    <div class="error"><?= $errorMsg ?></div>
                    <input type="submit" value="Add Member" name="sub" />
                </form>

    </body>

</html>