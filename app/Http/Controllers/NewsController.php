<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::with('category')->get();
        return response()->json($news);
    }

    public function GetLatestNews(){
        $news = News::where('Date_expiration', '>', Carbon::now())
        ->orderBy('Date_debut','desc')
        ->with('category')
        ->get();

        return response()->json($news, 200);
    }

    public function GetNewsById($id){
        $news = News::find($id);

        if(!$news)
        {
            return response()->json(['error' => 'not found'], 404);
        }
        return response()->json($news, 200);
    }


    public function CreateNew(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Titre' => 'required',
            'Contenu' => 'required',
            'category_id'=> 'required',
            'Date_debut'=> 'required',
            'Date_expiration'=> 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $creatednews = News::create($request->all());

        return response()->json($creatednews, 201);

    }


    public function UpdateNew(Request $request,$id)
    {
        $news = News::find($id);

        if(!$news)
        {
            return response()->json(['error' => 'News not found'], 404);
        }
        $validator = Validator::make($request->all(), [
            'Titre' => 'nullable',
            'Contenu' => 'nullable',
            'category_id'=> 'nullable',
            'Date_debut'=> 'nullable|date',
            'Date_expiration'=> 'nullable|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $news->fill($request->all())->save();

        return response()->json($news, 200);

    }



    public function DeleteNew($id)
    {
        $new = News::find($id);

        if(!$new)
        {
            return response()->json(['error' => 'there is no New with that id'], 404);
        }

        $new->delete();

        return response()->json(['message' => 'New deleted successfully'], 200);
    }

}
