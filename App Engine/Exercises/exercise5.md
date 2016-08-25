# Wire Application to use Cloud SQL

## Change Application to use Cloud SQL to Store picture details.  


* Add the following lines to process.php in the bottom of the top php block:

~~~~php
$db = new mysqli(null, $db_user, $db_pass, $db_name, null, '/cloudsql/' . $db_id);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$name = $db ->real_escape_string($_FILES['upload']['name']);
$url = $db ->real_escape_string($imageurl);
$sql = "INSERT INTO `image` (`name`,`url`) VALUES ('" . $name . "','" . $url . "')"; 
$result = $db -> query($sql);

~~~~

* Create new file named *index.php* and make its contents: 

~~~~php
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
~~~~

## Deploy App in App Engine Launcher
* Highlight project in list
* Click *Deploy* button
* Wait for deployment to finish
* Browse to http://&lt;your project id&gt;.appspot.com/upload.php

## Test that changes work
* Upload an image from upload.php
* Confirm it appears
* Browse to http://&lt;your project id&gt;.appspot.com/index.php
* Check to see that image is listed in bucket