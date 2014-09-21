<?php 

$cover = $_FILES["pic"];

$fileid= $_POST["item"];

$target_path = "./../../userServer/Request/request_img/";

if($cover["error"]>0) 
{
    echo "err";
} 
else 
{
        // Get the extension name by uploaded filename
    $extName = substr( $cover["name"],strrpos($cover["name"],".") );
        // check the file type is image
    $isImage =  getimagesize ($cover["tmp_name"]) ;

        // only jpg or png file name ( or custom by yourself)
    if($isImage) 
    {
        if( move_uploaded_file($cover["tmp_name"], $target_path .$fileid.".png") )
        {
            echo $fileid.".png"; 
                // print the filename if success
        } 
        else 
        {
            echo "err";
                // move upload file failed
        }
    } 
    else 
    {

        echo "err";
            // err file type
    }
}
?>