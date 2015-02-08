<? // Used to allow a user to login into the MySQL Database
require_once("utils/required.php");  // Contains the other required php scripts.

session_start();

// Checks to make sure a username and password was passed in.
if (!isset($_GET['user']) || !isset($_GET['password'])) {
  $error = error(constant("ERROR"), "Need Username and Password");
  die ($error);
}

// Grabs user and password from request url.
$user = $mysqli->real_escape_string($_GET['user']);
$password = $mysqli->real_escape_string($_GET['password']);

// Checks to see if the specified user exists in the database.
$userQuery = "SELECT password FROM user WHERE username = '$user' LIMIT 1";
$result = $mysqli->query($userQuery);
if (!$result) {
  $error = error(constant("INVALID_USER"), "Invalid Username");
  die ($error);
}

// Grabs the password from the database and checks to see if it equals
//  what the user specified.
$hashPassword = $result->fetch_object()->password;
if (!password_verify($password, $hashPassword)) {
  $error = error(constant("INCORRECT_PASSWORD"), "Incorrect Password");
  die ($error);
}

// Creates a session for the user.
$_SESSION['user'] = $user;
$_SESSION['last_interacted'] = time();

$json = error(constant("SUCCESS"), "Successfully logged in.");
echo $json;
?>
