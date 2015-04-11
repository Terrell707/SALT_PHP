<? // Inserts an expert and the ticket they observed into the witness database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the user is still logged in.

$insertQuery = "INSERT INTO witness VALUES (?, ?)";

$expert_id = $mysqli->real_escape_string($_GET['expert_id']);
$ticket_no = $mysqli->real_escape_string($_GET['ticket_no']);

// Prepare the insert statment.
$insertStmt = $mysqli->stmt_init();
if ($insertStmt->prepare($insertQuery)) {
  // Bind each of the values to the query and then execute it.
  $insertStmt->bind_param('ii', $expert_id, $ticket_no);
  $insertStmt->execute();

  // Grab the number of rows that we inserted.
  $affectedRows = $insertStmt->affected_rows;
  $insertStmt->close();

  if ($affectedRows < 0) {
    // If a -1 or less is returned, then something went wrong with the insert.
    $json = error(constant("ERROR"), "Something went wrong with the witness insert. Nothing was inserted.");
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
