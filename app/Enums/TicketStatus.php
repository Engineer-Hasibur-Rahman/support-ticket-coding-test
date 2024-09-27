<?php

namespace App\Enums;

class TicketStatus
{
    const PENDING = 0;
    const OPEN = 1;
    const CLOSED = 2;

    public static function getStatus(): array
    {
        return [
            self::PENDING,
            self::OPEN,
            self::CLOSED,
        ];
    }

}
