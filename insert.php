<?

session_start();
$query="SELECT * FROM employee";

echo $_SESSION['user'];

session_destroy();

echo $_SESSION['user'];

// $result=$conn->query($query);
//
// $rows=$result->num_rows;
//
// $a = array();
//
// while ($field = $result->fetch_object()) {
//   $info = array();
//
//   $info["id"]=$field->id;
//   $info["emp_id"]=$field->emp_id;
//   $info["first"]=$field->first_name;
//   $info["middle"]=$field->middle_init;
//   $info["last"]=$field->last_name;
//   $info["phone"]=$field->phone_number;
//
//   array_push($a, $info);
// }
//
// $result->close();
// $json = json_encode($a);
// echo $json;

$conn->close();
?>
