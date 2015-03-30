<? // Inserts an expert into the Expert database.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the user is still logged in.

$insertQuery = "INSERT INTO expert VALUES (?, ?, ?, ?, ?)";

$expert_no = $mysqli->real_escape_string($_GET['expert_id']);
$first_name = $mysqli->real_escape_string($_GET['first_name']);
$last_name = $mysqli->real_escape_string($_GET['last_name']);
$role = $mysqli->real_escape_string($_GET['role']);
$active = $mysqli->real_escape_string($_GET['active']);

// Prepare the insert statment.
$insertStmt = $mysqli->stmt_init();
if ($insertStmt->prepare($insertQuery)) {
  // Bind each of the values to the query and then execute it.
  $insertStmt->bind_param('isssi', $expert_id, $first_name, $last_name, $role,
    $active);
  $insertStmt->execute();

  // Grab the number of rows that we inserted.
  $affectedRows = $insertStmt->affected_rows;
  $insertStmt->close();

  if ($affectedRows < 0) {
    // If a -1 or less is returned, then something went wrong with the insert.
    $json = error(constant("ERROR"), "Something went wrong with the expert insert. Nothing was inserted.");
  }
  else {
    // Otherwise, return a success json object with the ID for the new record.
    $records = array();
    $record = array();
    $record['expert_id'] = "$mysqli->insert_id";
    array_push($records, $record);
    $json = success($records, constant("SUCCESS"), "$affectedRows inserted.");
  }
}
else {
  // Return an error json object.
  $json = error(constant("QUERY_FAILED"), "Insert failed: $mysqli->error");
}

echo $json;

?>
