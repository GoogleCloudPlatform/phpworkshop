# Creating a Simple PHP App on Container Engine

## Create Container Engine CLuster
* Go to [Google Container Engine](https://cloud.google.com/console/kubernetes) 
* Click *Create a container cluster* button
* Create Cluster with the following options


| Item        | Value        | 
| ------------- |-------------| 
| **Name:**         | cluster-1    | 
| **Description:**         | &lt; Leave Blank &gt;    | 
| **Zone:**         | Choose one close to you    | 
| **Machine Type:**         | 1 vCPU    | 
| **Size:**         | 3    | 

* Leave the rest default
* Click *Create* Button
* Wait for cluster to finish starting up

## Configure Container Engine
* Click *cluster1* on the Contaienr clusters list. 
* Make note of Endpoint IP
* Run `gcloud container clusters get-credentials cluster-1`
* Confirm response is: 
~~~~
Fetching cluster endpoint and auth data.
kubeconfig entry generated for cluster-1.
~~~~~
* Run `kubectl cluster-info`
* Confirm that `Kubernetes master is running at` matches Endpoint IP from above.

## Build Containers
* Launch Terminal
* Go to workshop folder 
* Run `cd "Container Engine/Container"`
* Run `docker build -t gcr.io/<Your Project ID>/php .`
* Run `gcloud docker push gcr.io/<Your Project ID>/php`


## Confirm Build
* Go to [Google Container Registry](https://cloud.google.com/console/kubernetes/images/list)
* Confirm the existance of *php* image 

## Create PHP application
* Launch Terminal
* Go to workshop folder (or run `cd ..` in previous window)
* Run `kubectl run php-deployment --image=gcr.io/<Your Project ID>/php --port=80 --replicas=3 `
* Run `kubectl get pods`
* Confirm that you have 3 pods running
* Note the name of one of the pods
* Run `kubectl delete pod <Pod name>`
* Confirm that you still have 3 pods running (or creating)

## Expose PHP Application
* Run `kubectl expose deployment php-deployment --port=80 --target-port=8080 --type=LoadBalancer`
* Run `kubectl get service`
* Run a couple of times and see EXTERNAL-IP change from *pending* to a value. 
* Drop that value into a browser.
* Confirm page content is *It Works* followed by `var_dump()` output. 

## Cool things to do

### Update the number of pods in your deployment
* Run `kubectl edit deployment php-deployment`
* Scroll down to *replicas*
* Change the number
* Save and exit
* Run `kubectl get pods`
* Confirm that you have the right number of pods running

### Get the yaml for your setup
* Run `kubectl get -o yaml deployment php-deployment`
* Run `kubectl get -o yaml service php-deployment`
* You can use this content to create entities straight from yaml files. 

### Create Kubernetes entity from yaml
* Go to workshop folder
* Run `cd kubernetes`
* Run `kubectl create -f nginx-pod.yaml`
* Run `kubectl get pods`
* Confirm that you have and nginx pod running or starting

## Tear down
* Go to [Google Container Engine](https://cloud.google.com/console/kubernetes) 
* Click on checkmark next to *cluster-1* 
* Click *Delete* button and confirm.
* Go to [Google Container Registry](https://cloud.google.com/console/kubernetes/images/list)
* Click on link to *php* image in list
* Click on checkmark in the begining of the line with *latest* in it.  
* Click *Delete* button, type 'DELETE' and confirm.