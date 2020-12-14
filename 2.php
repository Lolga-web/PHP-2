<?php
trait getInstance {
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new self;
        }
        return self::$_instance;
    }
}

class someClass {
    protected static $_instance;

    private function __construct() {

    }

    use getInstance;

    private function __clone() {

    }
    private function __wakeup() {

    }
}

