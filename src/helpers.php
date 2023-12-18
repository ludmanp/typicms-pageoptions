<?php

if (!function_exists('nameToInput')) {
    function nameToInput(string $name): string
    {
        return implode(
            '',
            array_map(function ($el) {
                return '[' . $el . ']';
            }, explode('.', $name))
        );
    }
}
