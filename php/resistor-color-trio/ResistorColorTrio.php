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

use LDAP\Result;

class ResistorColorTrio
{
    private const color_map = [
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

    private const units = [
        "gigaohms" => 1_000_000_000,
        "megaohms" => 1_000_000,
        "kiloohms" => 1_000,
        "ohms" => 1,
    ];

    public function label(array $colors): string
    {
        if (count($colors) < 3 || (
                isset($this::color_map[$colors[0]]) === false ||
                isset($this::color_map[$colors[1]]) === false ||
                isset($this::color_map[$colors[2]]) === false))
        {
            return "";
        }

        $ohms = 0;

        $ohms = $ohms * 10 + $this::color_map[$colors[0]];
        $ohms = $ohms * 10 + $this::color_map[$colors[1]];

        $ohms *= pow(10, $this::color_map[$colors[2]]);
        $suffix = 'ohms';

        foreach ($this::units as $name => $divisor)
        {
            if ((int)($ohms / $divisor) > 0)
            {
                $ohms /= $divisor;
                $suffix = $name;
                return "$ohms $suffix";
            }
        }

        return "$ohms $suffix";
    }
}