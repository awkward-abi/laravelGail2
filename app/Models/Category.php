<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model {

   use HasFactory;

   //protected $fillable = ['title','description','parent_id'];

   protected $table = 'categories';
   protected $primaryKey ='id';
   protected $fillable = ['id','title','description'];

   public function subcategories(): BelongsToMany //optional ang BelongsToMany 
   {
       return $this->belongsToMany(SubCategory::class,'category_sub_category');
   }

   
   
}


