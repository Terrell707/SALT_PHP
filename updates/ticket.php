<? // Updates a ticket in the ticket database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the user is still logged in.

$updateQuery = "UPDATE ticket SET ticket_no = ?, order_date = ?, call_order_no = ?,
  first_name = ?, last_name = ?, soc = ?, hearing_date = ?, hearing_time = ?,
  status = ?, emp_worked = ?, judge_presided = ?, at_site = ?
  WHERE ticket_no = ?";

$ticket_no = $mysqli->real_escape_string($_GET['ticket_no']);
$order_date = $mysqli->real_escape_string($_GET['order_date']);
$call_order_no = $mysqli->real_escape_string($_GET['call_order_no']);
$first_name = $mysqli->real_escape_string($_GET['first_name']);
$soc = $mysqli->real_escape_string($_GET['soc']);
$last_name = $mysqli->real_escape_string($_GET['last_name']);
$hearing_date = $mysqli->real_escape_string($_GET['hearing_date']);
$hearing_time = $mysqli->real_escape_string($_GET['hearing_time']);
$status = $mysqli->real_escape_string($_GET['status']);
$emp_worked = $mysqli->real_escape_string($_GET['emp_worked']);
$judge_presided = $mysqli->real_escape_string($_GET['judge_presided']);
$at_site = $mysqli->real_escape_string($_GET['at_site']);

// Update the ticket that has (or had) this ticket number.
$ref_ticket_no = $mysqli->real_escape_string($_GET['ref_ticket_no']);

// Prepare the insert statment.
$updateStmt = $mysqli->stmt_init();
if ($updateStmt->prepare($updateQuery)) {
  // Bind each of the values to the query and then execute it.
  $updateStmt->bind_param('issssssssiiss', $ticket_no, $order_date, $call_order_no,
    $first_name, $last_name, $soc, $hearing_date, $hearing_time, $status, $emp_worked,
    $judge_presided, $at_site, $ref_ticket_no);
  $updateStmt->execute();

  // Grab the number of rows that we inserted.
  $affectedRows = $updateStmt->affected_rows;
  $updateStmt->close();

  if ($affectedRows < 0) {
    // If a -1 or less is returned, then something went wrong with the insert.
    $json = error(constant("ERROR"), "Something went wrong with the ticket update. Nothing was updated.");
  }
  else {
    // Otherwise, return a success json object.
    $json = error(constant("SUCCESS"), "$affectedRows updated.");
  }
}
else {
  // Return an error json object.
  $json = error(constant("QUERY_FAILED"), "Update failed: $mysqli->error");
}

echo $json;

?>
