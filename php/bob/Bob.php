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

class Bob
{
    private const supportedEncodings = ['UTF-8'];

    public function respondTo(string $str): string
    {
        $encoding = mb_detect_encoding($str, Bob::supportedEncodings, true);
        if ($encoding === false)
        {
            throw new Exception("Unknown encoding.");
        }

        $str = trim($str);
        if (mb_strlen($str) === 0)
        {
            return "Fine. Be that way!";
        }
        
        $lastChar = $str[mb_strlen($str, $encoding) - 1];
        $upperCaseStr = mb_strtoupper($str, $encoding);
        $hasAlphaStr = $upperCaseStr !== mb_strtolower($str);

        if ($lastChar == '?' && $upperCaseStr === $str && $hasAlphaStr)
        {
            return "Calm down, I know what I'm doing!";
        }
        else if ($upperCaseStr === $str && $hasAlphaStr)
        {
            return "Whoa, chill out!";
        }
        else if ($lastChar === "?")
        {
            return "Sure.";
        }
        return "Whatever.";
    }
}
