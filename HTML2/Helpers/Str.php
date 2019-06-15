<?php


namespace App\Helpers\Table\HTML2\Helpers;


class Str
{
    public static function SubPosReplace($subject, $replacement, string $needle,  $plus_pos = 0, $length = 0)
    {
        return substr_replace($subject, $replacement, strpos($subject, $needle) + $plus_pos, $length);
    }

    public static function appendTo(&$willBeAppended, $append, int $pos = 0, int $length = 0)
    {
        $willBeAppended = substr_replace($willBeAppended, $append, $pos, $length);
    }

    public static function replaceLast( $search , $replace , $subject, int $plus_pos = 0, int $length = 0 ) {
        $str = substr_replace($subject, $replace,
            strrpos($subject, $search) + $plus_pos , $length);

        return $str;
    }

    public static function compareWithLengthAuto($toCompare, $ccompare, $pos = 0)
    {
        $len = strlen($ccompare);
        return substr($toCompare, $pos, $len) == $ccompare;
    }


    public static function lastWord($delimiter, $subject)
    {
        $subject = explode($delimiter, $subject);

        $subject = array_flip($subject);
        $last_phrase = array_key_last($subject);

        return $last_phrase;

    }
}