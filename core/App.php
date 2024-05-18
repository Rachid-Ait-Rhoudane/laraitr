<?php

namespace core;

class App {

    private static $container = null;

    public static function setContainer() {

        if(!static::$container) {
            static::$container = new Container();
        }
    }
    
    public static function bind($key, $resolver) {

        static::$container->bind($key, $resolver);
    }

    public static function resolve($key) {

        return static::$container->resolve($key);
    }
}