<?php
 
namespace App\Models;
 
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'employer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'photo',
        'password',
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
}