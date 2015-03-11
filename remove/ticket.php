<? //Removes a ticket from the database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

// Checks to make sure a ticket number was passed in.
if (!isset($_GET['ticket_no'])) {
  $error = error(constant("ERROR"), "Can't remove ticket! No ticket number provided.");
  die ($error);
}

// Grabs the ticket number that was passed in.
$ticket_no = $_GET['ticket_no'];

// Prepare the statement.
$removeQuery = "DELETE FROM ticket WHERE ticket_no = ?";
$removeStmt = $mysqli->stmt_init();

// Execute the statment.
if ($removeStmt->prepare($removeQuery)) {
  // If successful, return the number of affected rows.
  $removeStmt->bind_param('i', $ticket_no);
  $removeStmt->execute();

  $affectedRows = $removeStmt->affected_rows;
  $removeStmt->close();

  if ($affectedRows < 0) {
    $json = error(constant("ERROR"), "There was an error in the remove statement.");
  }
  else if ($affectedRows == 0){
    $json = error(constant("ERROR"), "There was no row matching that ticket number.");
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
