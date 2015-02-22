<? // Inserts a ticket into the ticket database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

$insertQuery = "INSERT INTO ticket VALUES ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? ,?";

$ticket_no = $mysqli->real_escape_string($_GET['ticket_no']);
$order_date = $mysqli->real_escape_string($_GET['order_date']);
$call_order_no = $mysqli->real_escape_string($_GET['call_order_no']);
$first_name = $mysqli->real_escape_string($_GET['first_name']);
$last_name = $mysqli->real_escape_string($_GET['last_name']);
$bpa_no = $mysqli->real_escape_string($_GET['bpa_no']);
$can = $mysqli->real_escape_string($_GET['can']);
$tin = $mysqli->real_escape_string($_GET['tin']);
$soc = $mysqli->real_escape_string($_GET['soc']);
$hearing_date = $mysqli->real_escape_string($_GET['hearing_date']);
$hearing_time = $mysqli->real_escape_string($_GET['hearing_time']);
$status = $mysqli->real_escape_string($_GET['status']);
$emp_worked = $mysqli->real_escape_string($_GET['emp_worked']);
$judge_presided = $mysqli->real_escape_string($_GET['judge_presided']);
$at_site = $mysqli->real_escape_string($_GET['at_site']);

// Prepare the insert statment.
$insertStmt = $mysqli->stmt_init();
if ($stmt->prepare($insertQuery)) {
  // Bind each of the values to the query and then execute it.
  $stmt->bind_param('isssssisssssiis', $ticket_no, $order_date, $call_order_no,
    $first_name, $last_name, $bpa_no, $can, $tin, $soc, $hearing_date, $hearing_time,
    $status, $emp_worked, $judge_presided, $at_site);
  $stmt->execute();

  // Grab the number of rows that we inserted.
  $affectedRows = $stmt->affected_rows;
  $stmt->close();

  // Return a success json object.
  $json = error(constant("SUCCESS"), "$affectedRows inserted.");
  echo $json;

} else {

  // Return an error json object.
  $json = error(constant("QUERY_FAILED"), "Insert failed " . $mysqli->error);
  echo $json;
}
?>
