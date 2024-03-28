<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit99fb9ca199443b8062cbcaeca8099ddc
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Facebook\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Facebook\\' => 
        array (
            0 => __DIR__ . '/..' . '/facebook/graph-sdk/src/Facebook',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit99fb9ca199443b8062cbcaeca8099ddc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit99fb9ca199443b8062cbcaeca8099ddc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit99fb9ca199443b8062cbcaeca8099ddc::$classMap;

        }, null, ClassLoader::class);
    }
}
