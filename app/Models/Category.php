<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class Category extends Model {

   use HasFactory;

   //protected $fillable = ['title','description','parent_id'];

   protected $table = 'categories';
   protected $primaryKey ='id';
   protected $fillable = ['id','title','description'];

   public function subcategories()
   {
       return $this->hasMany(SubCategory::class);
   }

   
   
}


