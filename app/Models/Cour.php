<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $table = 'travaux';
    protected $fillable = ['code','displayname','description','type','document','status','dueDate','idPerson'];
}
