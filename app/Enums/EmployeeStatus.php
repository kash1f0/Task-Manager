<?php

namespace App\Enums;

enum EmployeeStatus: string
{
    case HIRED = 'hired';
    case REJECTED = 'rejected';

    case PENDING = 'pending';

}