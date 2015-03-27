<? // Handles error messages

function error($error_code, $error_message) {
  // Creates an empty array so that json will be returned as an array.
  $json = array();

  // Creates key-value pairs for the error_code.
  $error['error_code'] = $error_code;
  $error['error_message'] = $error_message;

  // Push the key-value pairs and creates a json object out of it.
  array_push($json, $error);

  // Turns the array into a json object.
  $json = json_encode($json);
  return $json;
}

function success($data, $error_code, $error_message) {
  // Creates an array out of the error code and message.
  $error = array();

  // Creates key-value pairs for the error_code.
  $error['error_code'] = $error_code;
  $error['error_message'] = $error_message;

  // Places the error code at the front of the data and returns it.
  array_unshift($data, $error);
  $json = json_encode($data);
  return $json;
}

?>
