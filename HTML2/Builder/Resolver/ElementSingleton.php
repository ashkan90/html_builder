<?php


namespace App\Helpers\Table\HTML2\Builder\Resolver;


use App\Helpers\Table\HTML2\Builder\Identifier\Element;

class ElementSingleton
{
    protected static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(Element $element)
    {
        if (static::$instance == null)
            static::$instance = $element;

        return static::$instance;
    }



    public function __clone()
    {
    }


    public function __wakeup()
    {
    }
}