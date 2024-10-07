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

class HighScores
{
    private array $scores;
    private array $personalTopThree;
    private int $latest;
    private int $personalBest;

    public function __construct(array $scores)
    {
        $this->scores = array_filter($scores, is_numeric(...));
        if (count($this->scores) < count($scores))
        {
            throw new InvalidArgumentException("There are non numeric values inside the array.");
        }

        $sortedScoresCopy = array_slice($this->scores, 0);
        rsort($sortedScoresCopy);
        
        $this->latest = end($this->scores);
        $this->personalBest = max($this->scores);
        $this->personalTopThree =  array_slice($sortedScoresCopy, 0, 3);
    }

    public function __get(string $name)
    {
        if (property_exists($this, $name))
        {
            return $this->$name;
        }
        throw new Exception("$name property does not exist.");
    }
}
