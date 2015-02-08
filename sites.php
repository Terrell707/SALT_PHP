<? // Gets all the information from the site table.
require_once("utils/required.php");    // Contains the other required scripts.
require_once("utils/user_status.php"); // Checks that the use is still logged in.

$siteQuery = "SELECT * FROM site";
$results = $mysqli->query($siteQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Site query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['office_code'] = $row->office_code;
  $record['name'] = $row->emp_name;
  $record['address'] = $row->address;
  $record['phone_number'] = $row->phone_number;
  $record['email'] = $row->email;

  // Adds this record to the list of records.
  array_push($records, $record);
}

$json = json_encode($records);
echo $json;
?>
