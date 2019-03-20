<?php
class Singleton
{
    public static $instance;

    static function i()
    {
        if (static::$instance === null) {
            include BD_ROOT_PATH.'db.php';
            $class = get_called_class();
            static::$instance = new $class($DB);
        }
        return static::$instance;
    }
}
