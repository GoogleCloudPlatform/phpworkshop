# Launching PHP on a VM

## Create VM
* Go to [Google Compute Engine](https://cloud.google.com/console/compute)
* We might see a "Compute Engine is getting ready. This may take a minute or 
more" message. If so wait it out.
* Click *Create Instance* button
* Create Instance with the following options


| Item        | Value        | 
| ------------- |-------------| 
| **Name:**         | instance-1    | 
| **Zone:**         | Choose one close to you    | 
| **Machine Type:**         | 1 vCPU    | 
| **Boot Disk:**         | Debian GNU/Linux 8 (jessie)    | 
| **Identity and API access:**         | keep default    |  
| **Firewall:**         | Allow HTTP traffic, Allow HTTPS traffic     | 

* Click the link at the bottom labeled *command line*.
* Note the command line instructions for creating this instance. 
* Click *Create* button  

## Access VM
* Wait for VM to finish starting up
* Click on *SSH* link


## Configure VM
* Run `sudo apt-get update`
* Run `sudo apt-get install php5-common libapache2-mod-php5 php5-cli` & type *Yes* to proceed. 
* Run `sudo /etc/init.d/apache2 restart`
* Go back to [Google Compute Engine Console](https://cloud.google.com/console/compute)
* Click on link to *External IP* of *instance-1*
* Confirm page content is *Apache2 Debian Default Page*

## Write a small PHP app
* Go back to SSH window to *instance-1*
* Run `cd /var/www/html`
* Run `sudo touch index.php`
* Run `sudo nano index.php` (Or choose editor of your preference)
* Make content as follows: 

~~~~php
<?php
echo "It Works<br />";
echo "<pre>";
var_dump($_SERVER);
echo "</pre>";
?>
~~~~

* Browse to http://&lt;External IP&gt;/index.php
* Confirm page content is *It Works* followed by `var_dump()` output. 

## Tear down
* Go to [Google Compute Engine](https://cloud.google.com/console/compute)
* Click on checkmark next to *instance-1* 
* Click *Delete* button and confirm.