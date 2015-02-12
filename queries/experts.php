<? // Gets all the information from the expert table.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

$expertQuery = "SELECT * FROM expert";
$results = $mysqli->query($expertQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Expert query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['expert_id'] = $row->expert_id;
  $record['first_name'] = $row->first_name;
  $record['last_name'] = $row->last_name;
  $record['role'] = $row->role;

  // Adds this record to the list of records.
  array_push($records, $record);
}

$json = json_encode($records);
echo $json;
?>
