<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'childcategory_name_en',
        'childcategory_name_ur',
        'childcategory_slug_en',
        'childcategory_slug_ur',
    ];
    public function category() {
        return $this -> belongsTo(Category::class,'category_id', 'id');
    }

    public function subcategory() {
        return $this -> belongsTo(SubCategory::class,'subcategory_id', 'id');
    }


}
