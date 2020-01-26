<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //Table
    protected $table = 'books';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    public $timestamps = false;
}
