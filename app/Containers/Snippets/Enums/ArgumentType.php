<?php

namespace App\Containers\Snippets\Enums;

/**
 *
 */
enum ArgumentType: string
{

    case string = 'string';
    case mapping = 'mapping';


    /**
     * @param mixed $value
     * @param ArgumentType $type
     * @return bool
     */
    public static function is(mixed $value, ArgumentType $type): bool
    {
        return match ($value) {
            $type, $type->value => true,
            default => false,
        };
    }
}
