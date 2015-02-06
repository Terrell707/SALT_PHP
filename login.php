<? // Used to allow a user to login into the MySQL Database
include_once("define_vars.php");
require("database.php");

session_start();

// Checks to make sure a username and password was passed in.
if (!isset($_GET['user']) || !isset($_GET['password'])) {
  echo constant("ERROR");
  die ("Need Username and Password");
}

// Grabs user and password from request url.
$user = $mysqli->real_escape_string($_GET['user']);
$password = $mysqli->real_escape_string($_GET['password']);

// Checks to see if the specified user exists in the database.
$userQuery = "SELECT password FROM user WHERE username = '$user' LIMIT 1";
$result = $mysqli->query($userQuery);
if (!$result) {
  echo constant("INVALID_USER");
  die ("Invalid Username");
}

// Grabs the password from the database and checks to see if it equals
//  what the user specified.
$hashPassword = $result->fetch_object()->password;

if (password_verify($password, $hashPassword)) {
  echo constant("SUCCESS");
  $_SESSION['user'] = $user;
  $_SESSION['logged_in'] = 1;
} else {
  echo constant("INCORRECT_PASSWORD");
  die ("Incorrect Password");
}
?>
