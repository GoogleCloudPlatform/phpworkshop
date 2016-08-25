# Launch TYPO3 on Compute Engine

## Create VM
* Go to [Google Cloud Launcher](https://cloud.google.com/launcher)
* Search for *TYPO3*
* 1 result should come up for TYPO3 Bitnami
* Click *TYPO3* card
* Review *Pricing* and *Package contents*
* Click *Launch on Compute Engine* 
* Configure with these settings

| Item        | Value        | 
| ------------- |-------------| 
| **Deployment Name:**         | typo3-1    | 
| **Zone:**         | Choose one close to you    | 
| **Machine Type:**         | f1-micro (1 vCPU, 0.6 GB memory)   | 
| **Boot Disk:**         | Standard Persistent Disk    | 
| **Disk Size in GB:**         | 10   | 
| **Firewall:**         | Allow HTTP traffic, Allow HTTPS traffic     | 

* Click *Create* button  
* Wait for deployment to finish. 

## Test VM
* Review information revealed by panel you should see the following:

| Item        | Value        | 
| ------------- |-------------| 
| **Site Address:**         | http://&lt; assigned IP &gt;     | 
| **Admin URL:**         | http://&lt; assigned IP &gt;/typo3     | 
| **Admin user:**         | user   | 
| **Admin password: <br /> (Temporary)**         | &lt; Random value &gt;      | 
| **Instance:**         | 	typo3-1-vm | 
| **Instance zone:**         | &lt; Whatever you had picked &gt;     | 
| **Instance machine type:**         | f1-micro     | 

* Click *Log into the admin panel* button
* Login to TYPO3 install using Admin user and  Admin password from above.
* Confirm that TYPO3 CMS 8.2.1 is installed and running. 
* Browse to http://&lt; assigned IP &gt; 
* Confirm that default TYPO3 install is visible.
* You can now fool around with VM exactly like you would anyother VM


## Tear down
* Go to [Google Compute Engine](https://cloud.google.com/console/compute)
* Click on checkmark next to *typo3-1-vm* 
* Click *Delete* button and confirm.