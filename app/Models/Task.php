<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'employer_id', // Assuming this is the foreign key for the employer
        'status', // Assuming a status field to track task status
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */

     public function employers()
     {
         return $this->belongsTo(Task::class);
     }

     public $casts = [
         'status' => EmployeeStatus::class, // Assuming EmployeeStatus is an enum or class that defines task statuses
         'due_date' => 'datetime', // Assuming due_date is a date field
         'created_at' => 'datetime',
         'updated_at' => 'datetime',
     ];
}
