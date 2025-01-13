<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit7ef6a243cc89f4490e72089d55745581
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit7ef6a243cc89f4490e72089d55745581', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit7ef6a243cc89f4490e72089d55745581', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit7ef6a243cc89f4490e72089d55745581::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
