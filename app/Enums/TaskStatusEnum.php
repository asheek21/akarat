<?php

namespace App\Enums;

enum TaskStatusEnum: string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';

    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Pending',
            self::COMPLETED => 'Completed',
        };
    }

    public function colors(): string
    {
        return match ($this) {
            self::PENDING => 'bg-red-100 text-red-700',
            self::COMPLETED => 'bg-green-100 text-green-700',
        };
    }
}
