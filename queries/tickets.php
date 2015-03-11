<? // Gets all the information from the ticket table.
require_once("../utils/required.php");  // Contains the other required scripts.
require_once("../utils/user_status.php");     // Checks that the use is still logged in.

$dateFrom = $mysqli->real_escape_string($_GET['from']);
$dateTo = $mysqli->real_escape_string($_GET['to']);
$limitTo = $mysqli->real_escape_string($_GET['limit']);

// Builds the query depending on the information passed in.
$ticketQuery = "SELECT * FROM ticket";
// If there is a date from, then we will add a where clause.
if ($dateFrom) {
  $ticketQuery = $ticketQuery . " WHERE hearing_date >= '$dateFrom'";
}
// If there is both a date from and date to, then we need to add an "AND" to seperate them.
if ($dateFrom && $dateTo) {
  $ticketQuery = $ticketQuery . " AND";
}
// If there is a date to, but no date from, then we need to add a "WHERE" clause. If there is
//  a date to and date from, then we just need to add the info for date to.
if ($dateTo) {
  if (!$dateFrom) {
    $ticketQuery = $ticketQuery . " WHERE";
  }
  $ticketQuery = $ticketQuery . " hearing_date <= '$dateTo'";
}
// If there is a limit to, then we need to order the result set and limit it to the first
//  whatever limit to is.
if ($limitTo) {
  $ticketQuery = $ticketQuery . " order by hearing_date LIMIT $limitTo";
}

// Run the query.
$results = $mysqli->query($ticketQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Ticket query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['ticket_no'] = $row->ticket_no;
  $record['order_date'] = $row->order_date;
  $record['call_order_no'] = $row->call_order_no;
  $record['first_name'] = $row->first_name;
  $record['last_name'] = $row->last_name;
  $record['soc'] = $row->soc;
  $record['hearing_date'] = $row->hearing_date;
  $record['hearing_time'] = $row->hearing_time;
  $record['status'] = $row->status;
  $record['emp_worked'] = $row->emp_worked;
  $record['judge_presided'] = $row->judge_presided;
  $record['at_site'] = $row->at_site;

  // Adds this record to the list of records.
  array_push($records, $record);
}

$json = json_encode($records);
echo $json;
?>
