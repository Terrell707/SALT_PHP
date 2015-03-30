<? // Inserts a ticket into the ticket database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the user is still logged in.

$insertQuery = "INSERT INTO ticket VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?, ?, ?)";

$ticket_no = $mysqli->real_escape_string($_GET['ticket_no']);
$order_date = $mysqli->real_escape_string($_GET['order_date']);
$call_order_no = $mysqli->real_escape_string($_GET['call_order_no']);
$first_name = $mysqli->real_escape_string($_GET['first_name']);
$soc = $mysqli->real_escape_string($_GET['soc']);
$last_name = $mysqli->real_escape_string($_GET['last_name']);
$hearing_date = $mysqli->real_escape_string($_GET['hearing_date']);
$hearing_time = $mysqli->real_escape_string($_GET['hearing_time']);
$status = $mysqli->real_escape_string($_GET['status']);
$full_pay = $mysqli->real_escape_string($_GET['full_pay']);
$emp_worked = $mysqli->real_escape_string($_GET['emp_worked']);
$judge_presided = $mysqli->real_escape_string($_GET['judge_presided']);
$at_site = $mysqli->real_escape_string($_GET['at_site']);

// Prepare the insert statment.
$insertStmt = $mysqli->stmt_init();
if ($insertStmt->prepare($insertQuery)) {
  // Bind each of the values to the query and then execute it.
  $insertStmt->bind_param('isssssssssiis', $ticket_no, $order_date, $call_order_no,
    $first_name, $last_name, $soc, $hearing_date, $hearing_time, $status, $full_pay,
    $emp_worked, $judge_presided, $at_site);
  $insertStmt->execute();

  // Grab the number of rows that we inserted.
  $affectedRows = $insertStmt->affected_rows;
  $insertStmt->close();

  if ($affectedRows < 0) {
    // If a -1 or less is returned, then something went wrong with the insert.
    $json = error(constant("ERROR"), "Something went wrong with the ticket insert. Nothing was inserted.");
  }
  else {
    // Otherwise, return a success json object.
    $json = error(constant("SUCCESS"), "$affectedRows inserted.");
  }
}
else {
  // Return an error json object.
  $json = error(constant("QUERY_FAILED"), "Insert failed: $mysqli->error");
}

echo $json;

?>
