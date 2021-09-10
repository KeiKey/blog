<?php

namespace App\Enums;

class Role extends Enum
{
    public const SUPERADMIN = 'Super Admin';
    public const ADMIN = 'Admin';
    public const USER = 'User';

    public static function default(): string
    {
        return self::USER;
    }
}
