<?php
namespace App;

use FilesystemIterator;

class Helper{

    /**
     *  Get Image Count
     */
    public static function getImageCount(){
        $fi = new FilesystemIterator(GALLERY_PATH, FilesystemIterator::SKIP_DOTS);
        printf("%d Items", iterator_count($fi));
    }

    /**
     * @param $path
     * @return string|string[]
     */
    public static function getFileExt($path){
        return pathinfo($path,PATHINFO_EXTENSION);
    }

    /**
     *  Save Image into directory
     */
    public static function saveImage(){

    }
}
