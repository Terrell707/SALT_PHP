<?php
/**
* We just want to hash our password using the current DEFAULT algorithm.
* This is presently BCRYPT, and will produce a 60 character result.
*
* Beware that DEFAULT may change over time, so you would want to prepare
* By allowing your storage to expand past 60 characters (255 would be good)
*/
include_once("define_vars.php");

$hash = '$2y$10$pYIIg2yMY5Ot/kKtJntfI.TQhXAaDsZayJQKPmSsX3yMDU3mpmrWO';
echo password_verify('abcd1234', $hash);

?>
