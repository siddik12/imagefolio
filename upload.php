<?php
$file_name = $_FILES['file']['name'];

// get file extension
$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

// get filename without extension
$filenamewithoutextension = pathinfo($file_name, PATHINFO_FILENAME);

if (!file_exists(getcwd(). '/Gallery')) {
    mkdir(getcwd(). '/Gallery', 0777);
}

$filename_to_store = 'image_' .uniqid(). '.' .$ext;
move_uploaded_file($_FILES['file']['tmp_name'], getcwd(). '/Gallery/'.$filename_to_store);
echo "File(s) uploaded successfully";
die;
