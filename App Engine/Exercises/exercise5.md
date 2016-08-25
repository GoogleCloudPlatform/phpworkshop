# Wire Application to use Cloud SQL

## Change Application to use Cloud SQL to Store picture details.  


* Add the following lines to process.php in the bottom of the top php block:

~~~~php
try{
    $db = new pdo(
    'mysql:unix_socket=/cloudsql/' . $db_id . ';dbname='. $db_name,
    $db_user,  // username
    $db_pass,      // password
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => $ex->getMessage())));
}


$stmt = $db->prepare("INSERT INTO `image` (`name`,`url`) VALUES (:name, :url)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':url', $url);

$name = $_FILES['upload']['name'];
$url = $imageurl;
$stmt->execute();

~~~~

* Create new file named *index.php* and make its contents: 

~~~~php
<?php
include "common.php";
try{
    $db = new pdo(
    'mysql:unix_socket=/cloudsql/' . $db_id . ';dbname='. $db_name,
    $db_user,  // username
    $db_pass,      // password
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch(PDOException $ex){
    die(json_encode(array('outcome' => false, 'message' => $ex->getMessage())));
}


try{
    $sql = "SELECT name, url FROM image;";
    $stmt = $db->prepare($sql);
    $stmt->execute();

} catch(PDOException $ex){
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