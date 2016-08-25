<?php
// 	Copyright 2015, Google, Inc.
//  Licensed under the Apache License, Version 2.0 (the "License");
//  you may not use this file except in compliance with the License.
//  You may obtain a copy of the License at

//     http://www.apache.org/licenses/LICENSE-2.0

//  Unless required by applicable law or agreed to in writing, software
//  distributed under the License is distributed on an "AS IS" BASIS,
//  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
//  See the License for the specific language governing permissions and
//  limitations under the License.

include "common.php";
try {
    $db = new pdo(
    'mysql:unix_socket=/cloudsql/' . $db_id . ';dbname='. $db_name,
    $db_user,  // username
    $db_pass,      // password
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (PDOException $ex) {
    die(json_encode(array('outcome' => false, 'message' => $ex->getMessage())));
}


try {
    $sql = "SELECT name, url FROM image;";
    $stmt = $db->prepare($sql);
    $stmt->execute();
} catch (PDOException $ex) {
    die(json_encode(array('outcome' => false, 'message' => $ex->getMessage())));
}


echo "<table><tr><th>Filename</th><th>URL</th></tr>";
while ($row = $stmt->fetch()) {
    echo '<tr>';
    echo '<td>' . $row['name'] . '<td />';
    echo '<td><a href="'. $row['url'] .'">' . $row['url'] . '</a><td />';
    echo '</tr>';
}

echo "</table>";
