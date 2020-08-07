<?php


namespace App;


class Editor
{

    public static $path = "/Gallery/";


    /**
     * @return string
     */
    public static function uploadImage()
    {
        $file_name = $_FILES['file']['name'];
        // get file extension
        $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!file_exists(getcwd() . self::$path)) {
            mkdir(getcwd() . GALLERY_PATH, 0777);
        }
        // Generate Unique File Name
        $filename_to_store = 'image_' . uniqid() . '.' . $ext;

        move_uploaded_file($_FILES['file']['tmp_name'], getcwd() . self::$path. $filename_to_store);
        return "File(s) uploaded successfully";
    }

    /**
     *  Save Image
     */
    public static function saveImage(){
        $img = $_POST['imgBase64'];
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);
        $file = GALLERY_PATH . uniqid() . '.png';
        $success = file_put_contents($file, $data);
        print $success ? $file : 'Unable to save the file.';
    }

}