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
        return $this->hasOne(BookDetail::class,'id','bookdetail_id');
    }

    public function  student()
    {
        return $this->hasOne(Student::class,'id','student_id');
    }

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
}
