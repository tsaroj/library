<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;

    protected $fillable = ['book_code', 'edition', 'price'];

    public function Borrow()
    {
        return $this->hasMany(Borrow::class);
    }

    public function Book()
    {
        return $this->belongsTo(Book::class);
    }
}
