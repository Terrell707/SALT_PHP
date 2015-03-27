<? // Gets all the information from the business table.
require_once("../utils/required.php");  // Contains the other required scripts.
require_once("../utils/user_status.php");     // Checks that the use is still logged in.

$businessQuery = "SELECT * FROM business";
$results = $mysqli->query($businessQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Business query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['name'] = $row->name;
  $record['tin'] = $row->tin;
  $record['soc'] = $row->soc;
  $record['bpa_no'] = $row->bpa_no;
  $record['duns_no'] = $row->duns_no;
  $record['contractor_id'] = $row->contractor_id;

  // Adds this record to the list of records.
 array_push($records, $record);
}

$json = success($records, constant("SUCCESS"), "Business query successful!");
echo $json;
?>
