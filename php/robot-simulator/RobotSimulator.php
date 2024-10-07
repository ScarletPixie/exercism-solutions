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

class RobotSimulator
{
    private const validDirections = [
        'east' => [1, 0], 'south' => [0, 1],
        'west' => [-1, 0], 'north' => [0, -1]
    ];
    private array $robotPosition;
    private array $robotDirection;

    /** @param int[] $position */
    public function __construct(array $position, string $direction)
    {
        if (in_array($direction, array_keys($this::validDirections), true) === false)
            throw new \BadMethodCallException("invalid direction", 1);
        elseif (count($position) !== 2)
            throw new \BadMethodCallException("invalid position", 2);

        $this->robotPosition = $position;
        $this->robotDirection = $this::validDirections[$direction];
    }

    public function instructions(string $instructions): void
    {
        $size = strlen($instructions);

        if (preg_replace("/[RLA]/", '', $instructions) !== '')
            throw new \BadMethodCallException("invalid instruction", 4);

        for ($i = 0; $i < $size; $i++)
        {
            $oldX = $this->robotDirection[0];
            switch ($instructions[$i])
            {
                case 'A':
                    $this->robotPosition[0] += $this->robotDirection[0];
                    $this->robotPosition[1] += -$this->robotDirection[1];
                    break;
                case 'R':
                    $this->robotDirection[0] = -$this->robotDirection[1];
                    $this->robotDirection[1] = $oldX;
                    break;
                case 'L':
                    $this->robotDirection[0] = $this->robotDirection[1];
                    $this->robotDirection[1] = -$oldX;
                    break;
            }
        }
    }

    /** @return int[] */
    public function getPosition(): array
    {
        return $this->robotPosition;
    }

    public function getDirection(): string
    {
        switch ($this->robotDirection)
        {
            case $this::validDirections['east']:
                return 'east';
            case $this::validDirections['south']:
                return 'south';
            case $this::validDirections['west']:
                return 'west';
            case $this::validDirections['north']:
                return 'north';
            default:
                throw new \RuntimeException("invalid direction state", 3);
        }
    }
}

/*
    R
    new X = -old Y
    new Y = old X
    [ 0, -1];
    [ 1,  0];
    [ 0,  1];
    [-1,  0];

    L
    new X = old Y
    new Y = -old X
    [ 0,  -1];
    [-1,  0];
    [ 0,  1];
    [ 1,  0];

*/