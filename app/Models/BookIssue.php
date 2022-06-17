<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    use HasFactory;

    public function books()
    {
        return $this->belongsTo(Book::class,'book_id','id');
    }

    public function students()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
