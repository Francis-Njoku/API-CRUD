<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book_author extends Model
{
    //Table
    protected $table = 'book_author';
    // Primary Key
    public $primaryKey = 'id';
    // Timestamps
    //public $timestamps = false;

    public function writeer()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function publisher()
    {
        return $this->belongsTo(Book::class, 'book_id');

    }
}
