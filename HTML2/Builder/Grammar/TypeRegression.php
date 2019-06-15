<?php


namespace App\Helpers\Table\HTML2\Builder\Grammar;


class TypeRegression
{
    /**
     * Decide whatever code type cannot be because code grammar.
     *
     * @param $what
     * @param string $nth
     */
    public static function cantBe($what, string $nth = 'Child')
    {
        $regression = new MethodCall();

        $regression->regression($what, $nth);
    }
}