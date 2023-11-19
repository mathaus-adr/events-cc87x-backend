<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PersonEvent extends Pivot
{
    protected $table = 'event_person';
    use HasFactory;
}
