<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit9cd8a497a991368bd4a380d37dd195e6
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
            $loader->prefixLengthsPsr4 = ComposerStaticInit9cd8a497a991368bd4a380d37dd195e6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit9cd8a497a991368bd4a380d37dd195e6::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
