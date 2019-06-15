<?php


namespace App\Helpers\Table\HTML2\Builder\Resolver;


use App\Helpers\Table\HTML2\Helpers\Str;

trait ElementTypeResolver
{

    /**
     * Used by searching in elements
     * @var string
     */
    private static $NEEDLE = '>';


    protected static function resolveTypeIfNot()
    {
        $html_element = self::$instance;

        if (is_null($html_element->getCompiled())) {
            self::edit_start();
            self::edit_class();
            self::edit_attributes();
            self::edit_inner_text();
            self::edit_end();

            self::setElementToBuilt();
        }
        else
            self::setElementToBuilt();

    }

    private static function setElementToBuilt()
    {
        self::$instance->setElement(self::$tag);
        self::$instance->setCompiled(self::$skeleton);
    }


    /**
     * Append 'tag' to start string which is '<>'.
     */
    private static function edit_start()
    {
        self::$skeleton = Str::SubPosReplace(self::$instance->start, self::$tag, self::$NEEDLE);
    }

    /**
     * Replace 'class' data into 'any' tag.
     */
    private static function edit_class()
    {
        $class = ' class="' . self::$instance->getClass() .'"';
        self::$skeleton = Str::SubPosReplace(self::$skeleton, $class, self::$NEEDLE);
    }

    /**
     * Replace 'attribute(s)' data before <tag> symbol end.
     */
    private static function edit_attributes()
    {
        $attributes = ' '.self::$instance->getAttributes();
        self::$skeleton = Str::SubPosReplace(self::$skeleton, $attributes, self::$NEEDLE);
    }

    /**
     * Append 'text' to 'any' element.
     */
    private static function edit_inner_text()
    {
        $innerText = self::$instance->getInnerText();
        self::$skeleton = Str::SubPosReplace(self::$skeleton, $innerText, self::$NEEDLE, 1);
    }

    /**
     * Append 'tag' to end string which is '</>'.
     */
    private static function edit_end()
    {
        self::$skeleton .= Str::SubPosReplace(self::$instance->end, self::$tag, self::$NEEDLE);
    }
}