# Create Storage Bucket

## Open Cloud Storage Interface
* Go to [Google Cloud Storage](https://cloud.google.com//storage)
* Confirm that a default bucket has been created. 

## Create Default Bucket (Optional)
If no default bucket exists, create one:

| Item        | Value        | 
| ------------- |-------------| 
| **Name:**         | &lt;your project id&gt;.appspot.com    | 
| **Storage Class:**         | Standard    | 
| **Location:**         | Asia, European Union, or United States    | 

## Set permissions
* Select Context menu on right hand side (3 vertical dots)
* Choose *edit object default permissions* 
* Set the default object permissions to:

| Entity        | Name        | Access  |
| ------------- |-------------| -----|
| Group         | allUsers    | Read |

*Why are we doing this?*  
Becuase we want to serve up these images from our 
    application, but by default our files are not shared. 
    This step ensures that the iamges we upload are world 
    readable by default.