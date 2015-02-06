<? // Allows user to change their password.
include_once("define_vars.php");  // Contains constants that are used throughout.
require("database.php");          // Returns the $mysqli object.

// Grabs the user's current session.
session_start();

// Checks to make sure we have an open mysql connection and that the user is logged in.
if (!isset($_SESSION['user']) || !isset($_SESSION['logged_in'])) {
  echo constant("NOT_LOGGED_IN");
  die ("User not logged in!");
}

// Grabs the old and new user password.
$user = $_SESSION['user'];
$password = $_GET['password'];
$newPassword = $_GET['newPassword'];

// Checks to make sure the session user is the current user.
if ($_SESSION['user'] != $user) {
  echo constant("NOT_LOGGED_IN");
  die ("User not logged in!");
}

// Query the database.
$passwordQuery = "SELECT password FROM user WHERE username = '$user' LIMIT 1";
$userInfo = $mysqli->query($passwordQuery);
if (!$userInfo) {
  echo constant("INVALID_USER");
  die ("Invalid Username");
}

// Stores the result and closes the result set.
$hashedPassword = $userInfo->fetch_object()->password;
$userInfo->close();

// Checks if the password is correct.
if (!password_verify($password, $hashedPassword)) {
  // If password is wrong, terminate the script.
  echo constant("INCORRECT_PASSWORD");
  die ("Incorrect Password!");
} else {
  // Otherwise, write the new password to the database.
  $newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
  $passwordQuery = "UPDATE user SET password = '$newPassword' WHERE username = '$user'";
  $mysqli->query($passwordQuery);
  // If the query failed,
  if ($mysqli->affected_rows != 1) {
    echo constant("QUERY_FAILED");
    die ("Update query failed!");
  }

  echo constant("SUCCESS");
}

?>
