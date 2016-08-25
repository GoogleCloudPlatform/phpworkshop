# Troublshooting

Just a couple of things that came up during the writing of that could help at workshop time. 

## Web UI
### Deterimine Project ID
* In Web UI, in top blue bar there is a dropdown to the left of the search box
* Click on drop down
* Project ID should be in the right side of list. 

## gcloud command line 

### Make sure default project is set
* Open a Terminal
* Run `gcloud config set project <Your Project ID>`

### Make sure defautl zone is set
* Open a Terminal
* Run `gcloud config set compute/zone <Your Project zone>`

### Make sure you are properly logged in
* Open a Terminal
* Run `gcloud auth login`