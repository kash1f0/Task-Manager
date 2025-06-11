<?php

class EmployeeStatus
{
    const HIRED = 'hired';
    const REJECTED = 'rejected';

    const PENDING = 'pending';

    /**
     * Get all statuses.
     *
     * @return array
     */
    public static function allStatuses()
    {
        return [
            self::HIRED,
            self::REJECTED,
            self::PENDING,
        ];
    }
}