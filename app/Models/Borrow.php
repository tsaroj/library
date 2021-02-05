<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = ['borrow_date','due_date','return_date'];

    public function  book_detail()
    {
        return $this->belongsTo(BookDetail::class);
    }

    public function  student()
    {
        return $this->belongsTo(Student::class);
    }

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
}
