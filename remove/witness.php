<? //Removes a witness from the database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

// Checks to make sure a expert_id and ticket_no was passed in.
if (!isset($_GET['expert_id']) && !isset($_GET['ticket_no'])) {
  $error = error(constant("ERROR"), "Can't remove witness! Need expert_id and ticket_no!");
  die ($error);
}

// Grabs the expert id and ticket number that was passed in.
$expert_id = $_GET['expert_id'];
$ticket_no = $_GET['ticket_no'];

// Prepare the statement.
$removeQuery = "DELETE FROM witness WHERE expert_id = ? AND ticket_no = ?";
$removeStmt = $mysqli->stmt_init();

// Execute the statment.
if ($removeStmt->prepare($removeQuery)) {
  // If successful, return the number of affected rows.
  $removeStmt->bind_param('ss', $expert_id, $ticket_no);
  $removeStmt->execute();

  $affectedRows = $removeStmt->affected_rows;
  $removeStmt->close();

  if ($affectedRows < 0) {
    $json = error(constant("ERROR"), "There was an error in the remove statement.");
  }
  else if ($affectedRows == 0){
    $json = error(constant("ERROR"), "There was no row matching that expert_id and ticket_no.");
  }
  else {
    $json = error(constant("SUCCESS"), "$affectedRows deleted");
  }
}
else {
  // If there was a problem executing the query, return an error.
  $json = error(constant("ERROR"), "Something went wrong with the remove.");
}

echo $json;
?>
