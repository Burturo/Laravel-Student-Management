<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;
    protected $table = 'people';

    protected $fillable = ['id', 'firstname', 'lastname', 'email', 'gender', 'type', 'userId'];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function courses()
    {
        return $this->hasMany(Cour::class, 'id_person');
    }

    public function travaux()
    {
        return $this->hasMany(Travail::class, 'id_person');
    }
}
