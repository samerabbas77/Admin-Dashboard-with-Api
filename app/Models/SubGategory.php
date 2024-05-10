<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubGategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name' ,
        'gategory_id'
    ];

    public function gategory()
    {
        return $this->belongsTo(Gategory::class,'gategory_id');
    }

    public function books()
    {
        return $this->hasMany(Book::class,'subGategory_id','id');
    }
}
