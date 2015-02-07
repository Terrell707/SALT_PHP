<? // Handles error messages

function error($error_code, $error_message) {
  $error['error_code'] = $error_code;
  $error['error_message'] = $error_message;
  $json = json_encode($error);
  return $json;
}

?>
