<!-- <?php
// $servername = 'localhost';
// $username = 'root';
// $password = '';
// $dbname = 'webtech_fall2024_reginald_ofori';

// // MySQLi Connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
?> -->


<?php
$host = 'localhost';
$db_name = 'webtech_fall2024_reginald_ofori';
$db_user = 'reginald.ofori';
// $db_password = '';
$db_password = 'Reggie11.';

// Create MySQLi connection
$conn = new mysqli($host, $db_user, $db_password, $db_name);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
