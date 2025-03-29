<?php declare(strict_types=1);

namespace Deviddev\BillingoApiV3Wrapper\Support;

use ArrayIterator;

class Arr {

     /**
     * Collapse an array of arrays into a single array.
     *
     * @param  iterable  $array
     * @return array
     */
    public static function collapse(iterable $array): array
    {
        if(class_exists('\Illuminate\Support\Arr'))
        {
            return Illuminate\Support\Arr::collapse($array);
        }

        return static::collapseNativeIterables($array);
    }

    /**
     * Collapse an array of iterables into a single array.
     *
     * @param  iterable  $array
     * @return array
     */
    protected static function collapseNativeIterables(iterable $array): array
    {

        $results = [];

        foreach ($array as $values) {
            if ($values instanceof ArrayIterator) {
                $values = (array) $values;
            } elseif (! is_array($values)) {
                continue;
            }

            $results[] = $values;
        }

        return array_merge([], ...$results);
    }

}
