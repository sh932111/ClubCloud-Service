<?php 

include('../lib/class.upload.php');

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
$old_file=_UPLOAD_DIR."/{$fileid}.png";

if(file_exists($old_file))
{
    unlink($old_file);
}

$img_handle = new upload($_FILES['pic'],"zh_TW");

if ($img_handle->uploaded) 
{
    $img_handle->file_safe_name = false;
    $img_handle->file_overwrite  = true;
    $img_handle->file_new_name_body   = $sn;
    $img_handle->image_convert = 'png';
    $img_handle->image_resize  = true;
    $img_handle->image_ratio_y  = true;
    $img_handle->image_ratio_x  = true;
    $img_handle->process($target_path);

    if ($img_handle->processed) 
    {
        $img_handle->clean();
    } 
    else 
    {
        die($img_handle->error);
    }
}

?>