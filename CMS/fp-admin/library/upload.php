<?php
function upload($path,$inputname,$FileType="",$max_size=500000){
if($FileType==""){
    $file_type = array(
        "jpg","png","jpeg","gif"
    );
}else{
    $file_type = $FileType;
}
$target_dir = $path;
$target_file = $target_dir . basename($_FILES[$inputname]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES[$inputname]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES[$inputname]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if(in_array($imageFileType,$file_type)) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES[$inputname]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES[$inputname]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

}
