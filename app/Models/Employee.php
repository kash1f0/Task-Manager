<?php
 
namespace App\Models;
 

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Employee extends Authenticatable
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employees';

    protected $guard = 'employee';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'aboutEmployee',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
}