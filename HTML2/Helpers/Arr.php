<?php


namespace App\Helpers\Table\HTML2\Helpers;


class Arr
{

    public static function only(array $array, $search)
    {
        $only_values = [];
        if (is_array($search)) {
            return array_intersect($array, $search);
        }

        foreach ($array as $item) {
            if ($item == $search)
                $only_values[] = $item;
        }
        
        return $only_values;

    }

    public static function except(array $array, $search)
    {
        $only_values = [];
        if (is_array($search)) {
            foreach ($array as $item) {
                if ($item != $search)
                    $only_values[] = $item;
            }

            return $only_values;
        }

        return array_diff($array, $search);
    }

    public static function has(array $array, $search) : bool
    {
        return in_array($search, $array);
    }
}