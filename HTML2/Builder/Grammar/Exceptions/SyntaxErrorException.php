<?php


namespace App\Helpers\Table\HTML2\Builder\Grammar;


use Exception;
use Throwable;

class SyntaxErrorException extends Exception implements Throwable
{

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}