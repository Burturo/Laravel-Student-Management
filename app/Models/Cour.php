<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cour extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $fillable = ['id', 'displayname', 'description', 'type', 'document', 'status', 'dueDate', 'id_person'];

    public function person()
    {
        return $this->belongsTo(Person::class, 'id_person');
    }
}
