<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $casts = [
        'authors' => 'array'
    ];
    protected $table = 'books';
    protected $fillable = ['name','isbn','authors','release_date','publisher','country','number_of_pages'];
}
