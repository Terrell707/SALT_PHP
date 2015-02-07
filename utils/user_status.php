<? // Checks to make sure user is still logged in.

// Grabs the user's current session.
session_start();

// Checks to make sure we have an open mysql connection and that the user is logged in.
if (!isset($_SESSION['user']) || !isset($_SESSION['last_interacted'])) {
  echo constant("NOT_LOGGED_IN");
  die ("User not logged in!");
}

// Checks to see if user has timed out, otherwise updated last interaction time.
if ((time() - $_SESSION['last_interacted']) > $TIMEOUT) {
  echo constant("TIMED_OUT");
  die ("<br>User timed out!");
}
$_SESSION['last_interacted'] = time();

?>
