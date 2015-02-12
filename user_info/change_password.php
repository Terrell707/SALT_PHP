<? // Allows user to change their password.
require_once("../utils/required.php")
require_once("../utils/user_status.php");       // Checks to see if user is still logged in.

// Grabs the old and new user password.
$user = $_SESSION['user'];
$password = $_GET['password'];
$newPassword = $_GET['newPassword'];

// Checks to make sure the session user is the current user.
if ($_SESSION['user'] != $user) {
  $error = error(constant("NOT_LOGGED_IN"), "User not logged in!");
  die ($error);
}

// Query the database.
$passwordQuery = "SELECT password FROM user WHERE username = '$user' LIMIT 1";
$userInfo = $mysqli->query($passwordQuery);
if (!$userInfo) {
  $error = error(constant("INVALID_USER"), "Invalid Username");
  die ($error);
}

// Stores the result and closes the result set.
$hashedPassword = $userInfo->fetch_object()->password;
$userInfo->close();

// Checks if the password is correct.
if (!password_verify($password, $hashedPassword)) {
  // If password is wrong, terminate the script.
  $error= error(constant("INCORRECT_PASSWORD"), "Incorrect Password");
  die ($error);
}

// Otherwise, write the new password to the database.
$newPassword = password_hash($newPassword, PASSWORD_BCRYPT);
$passwordQuery = "UPDATE user SET password = '$newPassword' WHERE username = '$user'";
$mysqli->query($passwordQuery);
// If the query failed,
if ($mysqli->affected_rows != 1) {
  $error = error(constant("QUERY_FAILED"), "Update query failed: " . $mysqli->error);
  die ($error);
}

// Return a success json object.
$json = error(constant("SUCCESS"), "Change Password was successful");
echo $json;
?>
