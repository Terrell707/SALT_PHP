<? // List of constants that are used to communicate script status.

// Success and Error
define("SUCCESS", 0);
define("ERROR", 1);

// Dealing with user login status
define("NOT_LOGGED_IN", 121);
define("TIMED_OUT", 122);
define("INVALID_USER", 123);
define("INCORRECT_PASSWORD", 124);

// Dealing with MySQL connection/query status.
define("MYSQL_CONNECTION", 125);
define("QUERY_FAILED", 126);

// Sets a timeout value of 5 minutes.
$TIMEOUT = 60 * 5;

?>
