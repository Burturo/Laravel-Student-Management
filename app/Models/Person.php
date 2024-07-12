<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $fillable = ['id','firstName','lastName','email','gender','type','userId'];
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
