<?php


namespace App\Helpers\Table\HTML2\Builder\Resolver;


use App\Helpers\Table\HTML2\Builder\Elements\Div;
use App\Helpers\Table\HTML2\Builder\Elements\H;
use App\Helpers\Table\HTML2\Builder\Elements\Header;
use App\Helpers\Table\HTML2\Builder\Grammar\Syntax;
use App\Helpers\Table\HTML2\Builder\Grammar\SyntaxErrorException;
use App\Helpers\Table\HTML2\Builder\Identifier\Element;
use App\Helpers\Table\HTML2\Helpers\Str;

trait ElementResolver
{
    use ElementTypeResolver;

    /**
     * Default length for element (div's index after '<' symbol is equal to 4).
     * @var int
     */
    private static $indexAfterElement = 4;

    /**
     * Instance of called element.
     * @var Element
     */
    private static $instance;

    /**
     * Will be replaced to compiled field of current element.
     * @var
     */
    private static $skeleton;

    /**
     * Placeholder for element's tag/element field.
     * @var
     */
    private static $tag;

    /**
     * Compile element for given instance
     *
     * @param Element $instance
     * @throws SyntaxErrorException
     */
    public static function make(Element &$instance)
    {
        self::$instance = $instance;
        self::$tag = strtolower(Str::lastWord('\\', get_class($instance)));

        self::$indexAfterElement = strlen(self::$tag) + 1; // index of element after '<' symbol.

        switch ($instance) {
            case $instance instanceof Div: {

                self::edit_element();

                self::bootRelations();
            } break;


            case $instance instanceof Header: {
                self::edit_element();

                self::bootRelations();
            } break;

            case $instance instanceof H: {
                self::$tag .= "$instance->header_number";
                self::$indexAfterElement += 1;

                self::edit_element();

                self::bootRelations();
            }  break;
        }
    }

    /**
     * (If root)Set element as 'root' and Append 'root' or 'child' string to its element.
     */
    private static function bootRelations() : void
    {
        if (! self::$instance->isChild()) {
            self::$instance->setRoot(self::$instance);

            Str::appendTo(self::$instance->compiled, ' root', self::$indexAfterElement);
        }
        else {
            Str::appendTo(self::$instance->compiled, ' child', self::$indexAfterElement);
        }
    }

    /**
     * Catch if there's a problem while building skeleton of element.
     *
     * @throws SyntaxErrorException
     */
    private static function edit_element()
    {
        self::skeleton_builder();

        Syntax::tagShouldBe(self::$instance,
            new SyntaxErrorException(sprintf("Syntax error on: '%s'.\n
                Tags should be start with '%s' and end with '%s'",
                self::$instance->getCompiled(),
                self::$instance->start,
                self::$instance->end)));
    }

    /**
     * Turn skeleton into real component/element.
     *
     */
    private static function skeleton_builder()
    {
        self::resolveTypeIfNot();
    }


    

}