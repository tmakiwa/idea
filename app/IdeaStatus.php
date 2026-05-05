<?php

declare(strict_types=1);

namespace App;

enum IdeaStatus: string
{
    case PENDING = 'pending';
    case IN_PREGRESS = 'in_progress';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::IN_PREGRESS => 'In Progress',
            self::COMPLETED => 'Completed'
        };

    }
}
