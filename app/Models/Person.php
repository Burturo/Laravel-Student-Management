<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'people';

    protected $fillable = ['id', 'firstName', 'lastName', 'email', 'gender', 'type', 'userId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function courses()
    {
        return $this->hasMany(Cour::class, 'idPerson');
    }

    public function travaux()
    {
        return $this->hasMany(Travail::class, 'idPerson');
    }
}
