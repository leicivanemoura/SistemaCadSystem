<?php
class AutoLoad {
    public function __construct()
            {spl_autoload_register();          
            }
}

spl_autoload_register(function ($class_name) {
    include_once $class_name . '.php';
});
?>