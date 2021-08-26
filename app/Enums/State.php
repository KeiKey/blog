<?php

namespace App\Enums;

class State extends Enum
{
    public const ACTIVE = 'Active';
    public const DISABLED = 'Disabled';

    public static function default(): string
    {
        return self::ACTIVE;
    }
}
