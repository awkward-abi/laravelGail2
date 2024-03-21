<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class SubCategory extends Model
{

    protected $table = 'sub_categories';
    protected $primaryKey ='id';

    protected $fillable = [
        'id',
        'sub_title'
    ];    
    

    public function category(): BelongsToMany
    {
        //code review maya
        return $this->belongsToMany(Category::class,'category_sub_category');
    }
}
