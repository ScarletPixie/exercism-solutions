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

class Robot
{
    private string $name;
    private static array $takenNames = ["DF000" => true];
    private const letterPrefixNum = 2;
    private const numberSuffixNum = 3;

    public function __construct()
    {
        $this->name = "DF000";
        $this->reset();
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function reset(): void
    {
        $letters = range("A", "Z");
        $numbers = range("0", "9");
        $newNameStr = '';

        do
        {
            $newName = [];

            for ($i = 0; $i < $this::letterPrefixNum; $i++)
            {
                $newName[] = $letters[random_int(0, 25)];
            }
            
            for ($i = 0; $i < $this::numberSuffixNum; $i++)
            {
                $newName[] = $numbers[random_int(0, 9)];
            }

            $newNameStr = join('', $newName);
        } while (isset($this::$takenNames[$newNameStr]) && $this::$takenNames[$newNameStr] === true);

        $this->name = $newNameStr;
        $this::$takenNames[$this->name] = true;
    }
}
