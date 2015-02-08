<? // Checks to make sure user is still logged in.
require_once("required.php");

// Grabs the user's current session.
session_start();

// Checks to make sure we have an open mysql connection and that the user is logged in.
if (!isset($_SESSION['user']) || !isset($_SESSION['last_interacted'])) {
  $error = error(constant("NOT_LOGGED_IN"), "User not logged in");
  die ($error);
}

// Checks to see if user has timed out, otherwise updated last interaction time.
if ((time() - $_SESSION['last_interacted']) > $TIMEOUT) {
  $error = error(constant("TIMED_OUT"), "User timed out");
  die ($error);
}

// If user did not time out, then update their last interaction time.
$_SESSION['last_interacted'] = time();

?>
