<?php
include "common.php";
$db = new mysqli(null, $db_user, $db_pass, $db_name, null, '/cloudsql/' . $db_id);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

if(!$result = $db->query("SELECT name, url FROM image;")){
    die('There was an error running the query [' . $db->error . ']');
}

echo "<table>";
echo "<tr><th>Filename</th><th>URL</th></tr>";
while($row = $result->fetch_assoc()){
    echo '<tr>';
    echo '<td>' . $row['name'] . '<td />';
     echo '<td><a href="'. $row['url'] .'">' . $row['url'] . '</a><td />';
    echo '/<tr>';
}

echo "</table>"

?>