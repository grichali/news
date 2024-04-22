<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class News extends Model
{
    use HasFactory;

    protected $fillable = ['Titre','Contenu','category_id','Date_debut','Date_expiration'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public static function findNews($id){
        return News::find($id);
    }

    public static function getLatestNews(){
        return News::where('Date_expiration', '>', Carbon::now())
        ->orderBy('Date_debut','desc')
        ->with('category')
        ->get();
    }

    public static function getNewsByCategoryId($categoryId)
    {
        $category = Categories::find($categoryId);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $news = News::where('category_id', $category->id)
                    ->with('category')
                    ->get();

        return $news;
    }
}
