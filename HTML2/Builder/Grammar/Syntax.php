<?php


namespace App\Helpers\Table\HTML2\Builder\Grammar;


use App\Helpers\Table\HTML2\Builder\Grammar\Rules\IRule;
use App\Helpers\Table\HTML2\Builder\Identifier\Element;
use App\Helpers\Table\HTML2\Helpers\Arr;
use App\Helpers\Table\HTML2\Helpers\Str;

class Syntax implements IRule
{

    /**
     *
     * @var Element
     */
    private static $element;

    private static $previous;

    private const REGISTERED_TAGS = array(
        'div',
        'header',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6'
    );

    protected static $strict;

    /**
     * @param Element $element
     * @param null $previous
     * @return SyntaxErrorException|void
     * @throws SyntaxErrorException
     */
    public static function tagShouldBe(Element $element, $previous = null)
    {
        self::$element = $element;
        self::$previous = $previous;

        self::tagShouldGrammar();

    }

    /**
     * @return mixed
     * @throws SyntaxErrorException
     */
    public static function tagShouldGrammar()
    {
        $compiled = self::$element->getCompiled();
        $tag = self::$element->getElement();

        if (Str::compareWithLengthAuto($compiled, '<'. $tag)) { // start of compiled
            if (Str::compareWithLengthAuto(
                $compiled, $tag . '>', strrpos($compiled, $tag. '>'))) { // end of compiled
                return Arr::has(self::REGISTERED_TAGS, $tag); // no problem.
            }
        }


        throw new SyntaxErrorException("Something went wrong reading this element.\n'{$compiled}'", '404', self::$previous);

    }
}