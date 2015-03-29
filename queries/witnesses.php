<? // Gets all the information from the witness table.
require_once("../utils/required.php");    // Contains the other required scripts.
require_once("../utils/user_status.php"); // Checks that the use is still logged in.

$dateFrom = $mysqli->real_escape_string($_GET['from']);
$dateTo = $mysqli->real_escape_string($_GET['to']);

// Builds the query depending on the information passed in.
$witnessQuery = "SELECT w.expert_id, w.ticket_no FROM witness AS w, ticket AS t
                  WHERE w.ticket_no = t.ticket_no";

// If there is a date from, then we will add an "AND" to the end of the WHERE.
if ($dateFrom) {
  $witnessQuery = $witnessQuery . " AND hearing_date >= '$dateFrom'";
}
// If there is a date to, then we will add an "AND" to the end of the query.
if ($dateTo) {
  $witnessQuery = $witnessQuery . " AND hearing_date <= '$dateTo'";
}

// Run the query.
$results = $mysqli->query($witnessQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Witness query failed: " . $mysqli->error);
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
  $record['ticket_no'] = $row->ticket_no;

  // Adds this record to the list of records.
  array_push($records, $record);
}

$json = success($records, constant("SUCCESS"), "Witness query successful!");
echo $json;
?>
