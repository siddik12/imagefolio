<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcddae59fed2d1253a82649c8aa69e375
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcddae59fed2d1253a82649c8aa69e375::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcddae59fed2d1253a82649c8aa69e375::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}