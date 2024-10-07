<?php

declare(strict_types=1);

function language_list(string ...$args): array
{
    return $args;
}

function add_to_language_list(array $languages, string $new_language): array
{
    if (isset($languages) === true && isset($new_language) === true)
        array_push($languages, $new_language);
    return $languages;
}

function prune_language_list(array $languages): array
{
    array_shift($languages);
    return $languages;
}

function current_language(array $languages): string
{

    return $languages[0];
}

function language_list_length(?array $languages): int
{
    if (isset($languages) === false)
        return 0;
    return count($languages);
}