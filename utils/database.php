<? // Connects to database.
require_once("required.php");

// Grab user name and password for mysql database.
$server_name = "127.0.0.1";
$user = "sao";
$password = "saoave";
$database = "salt";

$mysqli = new mysqli($server_name, $user, $password, $database);

// Checks to see if there was a error in connecting.
if ($mysqli->connect_error) {
  $error = error(constant("MYSQL_CONNECTION"), "Connection failed: " . $mysqli->connect_error);
  die($error);
}

?>
