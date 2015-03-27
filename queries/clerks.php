<? // Gets all the information from the clerk table.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

$clerkQuery = "SELECT * FROM clerk";
$results = $mysqli->query($clerkQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Clerk query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['clerk_id'] = $row->clerk_id;
  $record['helps_judge'] = $row->helps_judge;
  $record['first_name'] = $row->first_name;
  $record['last_name'] = $row->last_name;
  $record['email'] = $row->email;

  // Adds this record to the list of records.
  array_push($records, $record);
}

$json = success($records, constant("SUCCESS"), "Clerks query successful!");
echo $json;
?>
