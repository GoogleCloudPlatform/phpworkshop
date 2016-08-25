<?php
include "common.php";

$db = new mysqli(
    null, // host
    $db_user, // username
    $db_pass,     // password
    $db_name, // database name
    null,
    '/cloudsql/' . $db_id
);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

if(!$result = $db->query("show tables;")){
    die('There was an error running the query [' . $db->error . ']');
}

while($row = $result->fetch_assoc()){
    echo $row['Tables_in_phpworkshop'] . '<br />';
}

?>