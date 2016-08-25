<?php

include "common.php";
use google\appengine\api\cloud_storage\CloudStorageTools;
$file_name = "gs://" . $bucket_name . "/" . $_FILES['upload']['name'];
$temp_name = $_FILES['upload']['tmp_name'];
move_uploaded_file($temp_name, $file_name);
$imageurl = CloudStorageTools::getPublicUrl($file_name, true);

$db = new mysqli(null, $db_user, $db_pass, $db_name, null, '/cloudsql/' . $db_id);

if($db->connect_errno > 0){
    die('Unable to connect to database [' . $db->connect_error . ']');
}

$name = $db ->real_escape_string($_FILES['upload']['name']);
$url = $db ->real_escape_string($imageurl);
$sql = "INSERT INTO `image` (`name`,`url`) VALUES ('" . $name . "','" . $url . "')"; 
$result = $db -> query($sql);

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