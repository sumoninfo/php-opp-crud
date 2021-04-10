<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite471a38e699d385cc6c20af6a75b2dba
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
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'App\\Config\\Database' => __DIR__ . '/../..' . '/src/config/Database.php',
        'App\\Controller\\ManagerController' => __DIR__ . '/../..' . '/src/controller/ManagerController.php',
        'App\\Controller\\MemberController' => __DIR__ . '/../..' . '/src/controller/MemberController.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite471a38e699d385cc6c20af6a75b2dba::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite471a38e699d385cc6c20af6a75b2dba::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite471a38e699d385cc6c20af6a75b2dba::$classMap;

        }, null, ClassLoader::class);
    }
}