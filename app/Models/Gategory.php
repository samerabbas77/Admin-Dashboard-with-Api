<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'descraption',
    ];

    public function books()
    {
        return $this->hasMany(Book::class,'gategory_id','id');
    }


    public function sub_gategories()
    {
        return $this->hasMany(SubGategory::class,'gategory_id');
    }
}
