<?php

class LuckyNumbers
{
    public function sumUp(array $digitsOfNumber1, array $digitsOfNumber2): int
    {
        $num1 = implode($digitsOfNumber1);
        $num2 = implode($digitsOfNumber2);

        return (int)$num1 + (int)$num2;
    }

    public function isPalindrome(int $number): bool
    {
        $copy = (string)$number;
        $revcopy = strrev((string)$number);

        return $copy === $revcopy;
    }

    public function validate(string $input): string
    {
        if ($input === null || $input === '')
            return ('Required field');
        else if ((int)$input <= 0)
            return ('Must be a whole number larger than 0');
        return '';
    }
}
