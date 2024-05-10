<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name' ,
        'gategory_id',        
        'subGategory_id',         
        'publisher_name',        
        'publish_date'
    ];

    public function gategory()
    {
        return $this->belongsTo(Gategory::class,'gategory_id','id');
    }

    public function subGategory()
    {
        return $this->belongsTo(SubGategory::class,'subGategory_id','id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class,'book_id','id');
    }
}
