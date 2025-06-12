<?php

namespace App\Enums;
enum TaskStatus: string
{
    case OPEN = 'open';
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELLED = 'cancelled';
    case IN_PROGRESS = 'in_progress';
}