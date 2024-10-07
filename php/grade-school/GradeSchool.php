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

class School
{
    private array $studentsData = [];

    public function add(string $name, int $grade): void
    {
        $name = trim($name);
        if (ctype_alpha($name) === false || $this->validGrade($grade) === false)
            throw new BadMethodCallException("invalid name/grade");

        $this->studentsData[$grade][] = $name;
        sort($this->studentsData[$grade]);
    }

    public function grade($grade)
    {
        if ($this->validGrade($grade) === false)
            throw new BadMethodCallException("invalid grade");

        $query = array_filter($this->studentsData, function($value, $key) use($grade) {
            return $key === $grade;
        }, ARRAY_FILTER_USE_BOTH);

        return (isset($query[$grade])) ? $query[$grade] : $query;
    }

    public function studentsByGradeAlphabetical(): array
    {
        $cpy = $this->studentsData;
        ksort($cpy);
        return $cpy;
    }

    private function validGrade(int $grade): bool
    {
        return $grade > 0 && $grade < 13;
    }
}

