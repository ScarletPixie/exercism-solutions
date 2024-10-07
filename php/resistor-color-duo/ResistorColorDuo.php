<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

class ResistorColorDuo
{
    private const COLORS_VALUES = [
        "black" => 0,
        "brown" => 1,
        "red" => 2,
        "orange" => 3,
        "yellow" => 4,
        "green" => 5,
        "blue" => 6,
        "violet" => 7,
        "grey" => 8,
        "white" => 9,
    ];

    public function getColorsValue(array $colors): int
    {
        $result = 0;
        $size = min(count($colors), 2);

        if ((isset($colors[0]) &&
            !array_key_exists($colors[0], $this::COLORS_VALUES)) &&
            (isset($colors[1]) &&
            !array_key_exists($colors[1], $this::COLORS_VALUES)))
        {
            throw new InvalidArgumentException('Unknown color');
        }

        for ($i = 0; $i < $size; $i++)
        {
            $result = $result * 10 + $this::COLORS_VALUES[$colors[$i]];
        }
        return $result;
    }
}
