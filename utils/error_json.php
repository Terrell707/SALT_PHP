<? // Handles error messages

function error($error_code, $error_message) {
  // Creates an empty array so that json will be returned as an array.
  $json = array();

  // Creates key-value pairs for the error_code.
  $error['error_code'] = $error_code;
  $error['error_message'] = $error_message;

  // Push the key-value pairs and creates a json object out of it.
  array_push($json, $error);
  $json = json_encode($json);
  return $json;
}

?>
