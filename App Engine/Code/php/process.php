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
use google\appengine\api\cloud_storage\CloudStorageTools;

$file_name = "gs://" . $bucket_name . "/" . $_FILES['upload']['name'];
$temp_name = $_FILES['upload']['tmp_name'];
move_uploaded_file($temp_name, $file_name);
$imageurl = CloudStorageTools::getPublicUrl($file_name, true);

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


$stmt = $db->prepare("INSERT INTO `image` (`name`,`url`) VALUES (:name, :url)");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':url', $url);

$name = $_FILES['upload']['name'];
$url = $imageurl;
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Displayer</title>
</head>
<body>
    <img src="<?php echo $imageurl; ?>" />
</body>
</html>