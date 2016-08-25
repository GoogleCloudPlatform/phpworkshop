<?php
    include "common.php";
    use google\appengine\api\cloud_storage\CloudStorageTools;
    $options = ['gs_bucket_name' => $bucket_name];
    $upload_url = CloudStorageTools::createUploadUrl('/process.php', $options);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Uploader</title>
</head>
<body>
    <form action="<?php echo $upload_url; ?>" method="post" enctype="multipart/form-data">
        <input type="file" name="upload"><br />
        <input type="submit" value="Upload" />
    </form>
</body>
</html>
