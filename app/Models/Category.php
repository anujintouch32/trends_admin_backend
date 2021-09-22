<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id')->where('parent_id',0);
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function category_product(){
        return $this->hasMany(Product::class);   
    }
}
