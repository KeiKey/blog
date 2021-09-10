<?php

namespace App\Enums;

class Status extends Enum
{
    public const NEW = 'New';
    public const IN_CONVERSATION = 'In conversation';
    public const CLOSED = 'Closed';

    public static function default(): string
    {
        return self::NEW;
    }
}
