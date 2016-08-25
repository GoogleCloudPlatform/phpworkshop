# Create Development Version of Application

## Create Code
Create an App.yaml containing:
~~~~yaml
application: <your project id>
version: alpha-001
runtime: php55
api_version: 1

handlers:
# Serve images as static resources.
- url: /(.+\.(gif|png|jpg))$
  static_files: \1
  upload: .+\.(gif|png|jpg)$
  application_readable: true

# Serve php scripts.
- url: /(.+\.php)$
  script: \1

  ~~~~

Create a file named "common.php" containing:
~~~~php
<?php
    $project_id = "gcp-php-workshop";
    $bucket_name = $project_id . ".appspot.com";
?>
~~~~

Create a file named "upload.php" containing:
~~~~php
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
~~~~

Create a file named "process.php" containing:
~~~~php
<?php
    include "common.php";
    use google\appengine\api\cloud_storage\CloudStorageTools;
    $file_name = "gs://" . $bucket_name . "/" . $_FILES['upload']['name'];
    $temp_name = $_FILES['upload']['tmp_name'];
    move_uploaded_file($temp_name, $file_name);
    $imageurl = CloudStorageTools::getPublicUrl($file_name, true);
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
~~~~



# Configure App in App Engine Launcher
* Launch App Engine Launcher
* Choose *File* 
* Choose *Add Existing Application*
* Target the folder containing your app.yaml
* Click the *Run* button
* Click the *Browse* button
* 404 error will result
* Point Browser at url with "upload.php" at end.