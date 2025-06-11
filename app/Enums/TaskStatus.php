<?php

class TaskStatus
{
    const OPEN = 'open';
    const PENDING = 'pending';
    const COMPLETED = 'completed';
    const CANCELLED = 'cancelled';

    /**
     * Get all statuses.
     *
     * @return array
     */
    public static function allStatuses()
    {
        return [
            self::OPEN,
            self::PENDING,
            self::COMPLETED,
            self::CANCELLED,
        ];
    }
}