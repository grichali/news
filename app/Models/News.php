<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;


class News extends Model
{
    use HasFactory;

    protected $fillable = ['Titre','Contenu','category_id','Date_debut','Date_expiration'];

    protected $hidden = ['created_at', 'updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Categories::class);
    }

    public static function index()
    {
        $news = News::with('category')
        ->orderBy('Date_debut','desc')
        ->get();
        return response()->json($news);
    }

    public static function createNew($request)
    {
        $creatednews = News::create($request->all());

        return response()->json($creatednews, 201);
    }


    public static function findNews($id)
    {
        $news = News::find($id);
        if(!$news)
        {
            return response()->json(['error' => 'not found'], 404);
        }
        return response()->json($news, 200);
    }

    public static function getLatestNews()
    {
        $news = News::where('Date_expiration', '>', Carbon::now())
        ->orderBy('Date_debut','desc')
        ->with('category')
        ->get();

        return response()->json($news, 200);
    }

    public static function updateNew($request,$id)
    {
        $news = News::find($id);

        if(!$news)
        {
            return response()->json(['error' => 'New not found'], 404);
        }

        $news->fill($request->all())->save();
        return response()->json($news, 200);
    }

    public static function deleteNew($id)
    {
        $new = News::find($id);

        if(!$new)
        {
            return response()->json(['error' => 'there is no New with that id'], 404);
        }

        $new->delete();

        return response()->json(['message' => 'New deleted successfully'], 204);
    }

    public static function getNewsByCategoryId($categoryname)
    {
        $category = Categories::where('nom', $categoryname)->first();

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $news = News::where('category_id', $category->id)
                    ->where('Date_expiration', '>', Carbon::now())
                    ->with('category')
                    ->get();

        return $news;
    }

}
