<?php
namespace App;

use FilesystemIterator;

class Helper{


    public static function getImageCount(){
        $fi = new FilesystemIterator(GALLERY_PATH, FilesystemIterator::SKIP_DOTS);
        printf("%d Items", iterator_count($fi));
    }
    public static function getFileExt($path){
        return pathinfo($path,PATHINFO_EXTENSION);
    }
}
