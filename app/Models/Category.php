<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name'];

    #Admin side displays categories
    public function categoryPost(){
        return $this->hasMany(CategoryPost::class);
    }
}
