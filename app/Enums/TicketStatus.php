<?php

namespace App\Enums;

enum TicketStatus: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case PROCESSED = 'processed';

    public function label(): string
    {
        return match($this) {
            self::NEW => 'Новый',
            self::IN_PROGRESS => 'В работе',
            self::PROCESSED => 'Обработан',
        };
    }
}
