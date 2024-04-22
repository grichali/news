<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $fillable = ['nom', 'parent_id'];

    protected $hidden = ['created_at', 'updated_at'];

    public function news(): HasMany
    {
        return $this->hasMany(News::class);
    }

    public function parent()
    {
        return $this->belongsTo(Categories::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Categories::class, 'parent_id');
    }

    public static function getSubcategories($categoryId)
    {
        // Find the category
        $category = Categories::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        // Retrieve the IDs of subcategories
        $subcategoryIds = Categories::where('parent_id', $category->id)->pluck('id');

        return $subcategoryIds;
    }


}
