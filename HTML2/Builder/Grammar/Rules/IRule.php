<?php


namespace App\Helpers\Table\HTML2\Builder\Grammar\Rules;

use App\Helpers\Table\HTML2\Builder\Identifier\Element;

interface IRule
{
    public static function tagShouldBe(Element $element, $previous = null) ;
    public static function tagShouldGrammar();

}