<?php


namespace App\Helpers\Table\HTML2\Builder\Grammar;


use BadMethodCallException;

class MethodCall extends BadMethodCallException
{
    public function regression($what, $nth = 'Child')
    {
        throw new BadMethodCallException("{$nth} element cannot be {$what}.",
            $this->getCode(), $this->getPrevious());
    }
}