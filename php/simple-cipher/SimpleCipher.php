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

class SimpleCipher
{
    public $key;
    private const DEFAULT_KEY_LENGTH = 100;
    private const KEY_CHARS_VALUES = [
        'a' => 0, 'b' => 1, 'c' => 2, 'd' => 3, 'e' => 4, 'f' => 5, 'g' => 6,
        'h' => 7, 'i' => 8, 'j' => 9, 'k' => 10, 'l' => 11, 'm' => 12, 'n' => 13,
        'o' => 14, 'p' => 15, 'q' => 16, 'r' => 17, 's' => 18, 't' => 19, 'u' => 20,
        'v' => 21, 'w' => 22, 'x' => 23, 'y' => 24, 'z' => 25
    ];

    public function __construct(string $key = null)
    {
        if ($key === null)
        {
            $this->key = $this->getRandomString(array_keys($this::KEY_CHARS_VALUES));
            return;
        }

        if (ctype_alpha($key) === false || ctype_upper($key) === true)
        {
            throw new InvalidArgumentException('the encoding key must not contain non-alphabetic characters.');
        }

        $this->key = $key;
    }

    public function encode(string $plainText): string
    {
        $encodedText = [];
        $textSize = strlen($plainText);
        $keySize = strlen($this->key);

        for ($i = 0; $i < $textSize; $i++)
        {
            $encodedText[] = $this->getEncodedChar($plainText[$i], $this->key[$i % $keySize]);
        }

        return join('', $encodedText);
    }

    public function decode(string $cipherText): string
    {
        $decodedText = [];
        $textSize = strlen($cipherText);
        $keySize = strlen($this->key);

        for ($i = 0; $i < $textSize; $i++)
        {
            $decodedText[] = $this->getDecodedChar($cipherText[$i], $this->key[$i % $keySize]);
        }
        return join('', $decodedText);
    }

    private function getRandomString(array $charsArray): string
    {
        $word = [];
        $size = count($charsArray);
        $chars = join('', $charsArray);

        for ($i = 0; $i < $this::DEFAULT_KEY_LENGTH; $i++)
        {
            $word[] = $chars[random_int(0, $size - 1)];
        }

        return join('', $word);
    }

    private function getEncodedChar(string $char, string $keyChar): string
    {
        if (isset($this::KEY_CHARS_VALUES[$char]) === false)
        {
            return $char;
        }

        $firstCaseLetter = ctype_upper($char) ? ord('A') : ord('a');
        $encodedCharOffset = (ord($char) - $firstCaseLetter) + $this::KEY_CHARS_VALUES[$keyChar];
        $encodedCharOffset %= 26;
        return chr($firstCaseLetter + $encodedCharOffset);
    }

    private function getDecodedChar(string $char, string $keyChar): string
    {
        if (isset($this::KEY_CHARS_VALUES[$char]) === false)
        {
            return $char;
        }

        $firstCaseLetter = ctype_upper($char) ? ord('A') : ord('a');
        $decodedCharOffset = (ord($char) - $firstCaseLetter) - $this::KEY_CHARS_VALUES[$keyChar];
        
        if ($decodedCharOffset < 0)
            $decodedCharOffset = $decodedCharOffset + 26;

        return chr($firstCaseLetter + $decodedCharOffset);
    }
}
