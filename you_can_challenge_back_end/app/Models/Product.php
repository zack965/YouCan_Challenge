<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        "name","description","price","image"
    ];
    protected $primaryKey="product_id";
    public function categories(){
        return $this->belongsToMany(Category::class,"product_category","product_id","categorie_id");
    }
}
