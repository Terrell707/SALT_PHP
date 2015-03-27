<? // Gets all the information from the employee table.
require_once("../utils/required.php");  // Contains the other required scripts.
require_once("../utils/user_status.php");     // Checks that the use is still logged in.

$employeeQuery = "SELECT * FROM employee";
$results = $mysqli->query($employeeQuery);

/// If the query failed, print an error message.
if (!$results) {
  $error = error(constant("QUERY_FAILED"), "Employee query failed: " . $mysqli->error);
  die ($error);
}

// Creates an array that will hold each row in the result set.
$records = array();

while ($row = $results->fetch_object()) {
  // Holds an individual record in the result set.
  $record = array();

  // Grabs each column from the current row and places it in the record array under the
  //  correct key.
  $record['id'] = $row->id;
  $record['emp_id'] = $row->emp_id;
  $record['first_name'] = $row->first_name;
  $record['middle_init'] = $row->middle_init;
  $record['last_name'] = $row->last_name;
  $record['phone_number'] = $row->phone_number;
  $record['email'] = $row->email;
  $record['street'] = $row->street;
  $record['city'] = $row->city;
  $record['state'] = $row->state;
  $record['zip'] = $row->zip;
  $record['pay'] = $row->pay;
  $record['active'] = $row->active;

  // Adds this record to the list of records.
 array_push($records, $record);
}

$json = success($records, constant("SUCCESS"), "Employee query successful.");
echo $json;
?>
