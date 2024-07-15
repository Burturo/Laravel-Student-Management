<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['code', 'displayname', 'description', 'type', 'document', 'status', 'dueDate', 'idPerson'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'idPerson');
    }
}
