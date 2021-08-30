<?php

namespace App\Enums;

class ResponseStatus
{
    public const SUCCESS = 'success';
    public const FAILURE = 'failure';
    public const NO_ACCESS = 'no_access';

    public static function default(): string
    {
        return self::NO_ACCESS;
    }
}
