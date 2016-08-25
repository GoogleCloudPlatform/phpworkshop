<!--
	Copyright 2015, Google, Inc.
 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
-->
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