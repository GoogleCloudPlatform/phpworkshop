# Setting up Cloud SQL

## Create Database instance

* Go to [Google Cloud SQL](https://cloud.google.com/console/sql/instances) in Console
* Click *Create Instance* button
* Click *Choose Second Generation* 
* Setup the instance with these settings: 

| Item        | Value        | 
| ------------- |-------------| 
| **ID:**         | phpworkshop    | 
| **Region:**         |us-centra1, us-east1, europe-west1, asia-east1    |  
| **Everything else:**         |Default    | 

* Click *Create* Button
* Wait for creation to complete
* Click on *phpworkshop* 
* Look around
* Note the value named *Instance connection name*


## Create Database Schema

* Create a file named "schema.sql" containing:

~~~~sql
DROP DATABASE IF EXISTS phpworkshop;
CREATE DATABASE IF NOT EXISTS phpworkshop;
USE phpworkshop;

CREATE TABLE `phpworkshop`.`image` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(2083) NULL,
  `url` VARCHAR(2083) NULL,
  PRIMARY KEY (`id`));

GRANT ALL PRIVILEGES ON phpworkshop.* TO 'phpworkshop_user'@'localhost'
IDENTIFIED BY PASSWORD '*4187302F295DF9910AA3B202389A2DABC97C89B2';

GRANT ALL PRIVILEGES ON phpworkshop.* TO 'phpworkshop_user'@'%'
IDENTIFIED BY PASSWORD '*4187302F295DF9910AA3B202389A2DABC97C89B2';
~~~~


* Go to [Google Cloud Storage](https://cloud.google.com/console)
* Click on &lt;Your Project ID&gt;.appspot.com bucket
* Click *Upload Files* button
* Chose Schema file that you made
* Deselct *Public Link* checkbox
* Go to [Google Cloud SQL](https://cloud.google.com/console/sql/instances) in Console
* Click on *phpworkshop* in list
* Navigate to your bucket in file selector
* Choose your Schema file
* Click *Import* button

## Test Database Schema
* Add these lines to common.php

~~~~php
$db_user = "phpworkshop_user";
$db_pass = "phpworkshop_user";
$db_name = "phpworkshop";
$db_host = "<Instance connection name>";
~~~~

* Create a file named *test_db.php* with this code: 

~~~~php
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
~~~~
* Launch App Engine Launcher 
* Highlight project in list
* Click *Deploy* button
* Wait for deployment to finish
* Browse to http://&lt;Your Project ID&gt;.appspot.com/test_db.php
* Page should just say 'image'
