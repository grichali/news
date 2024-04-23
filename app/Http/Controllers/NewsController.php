<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Categories;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    public function index()
    {
        return News::index();
    }

    public function getLatestNews()
    {
        return News::getLatestNews();
    }

    public function getNewsById($id)
    {
        return News::findNews($id);
    }


    public function createNew(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'Titre' => 'required',
            'Contenu' => 'required',
            'category_id'=> 'required',
            'Date_debut'=> 'required',
            'Date_expiration'=> 'required|date|after:Date_debut'
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 400);
        }

        return News::createNew($request);

    }


    public function updateNew(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'Titre' => 'nullable',
            'Contenu' => 'nullable',
            'category_id'=> 'nullable',
            'Date_debut'=> 'nullable|date',
            'Date_expiration'=> 'nullable|date',
        ]);

        if ($validator->fails())
        {
            return response()->json(['error' => $validator->errors()], 400);
        }

        return News::updateNew($request,$id);
    }



    public function deleteNew($id)
    {
        return News::deleteNew($id);
    }


    private $ListNews = [];
    public function searchNews($categoryname)
    {

        $newsarray= News::getNewsByCategoryId($categoryname)->toArray();

        $this->ListNews = array_merge($this->ListNews, $newsarray);

        $subcategories = Categories::getSubcategories($categoryname)->toArray();

        if(count($subcategories) == 0)
        {
            return response()->json($this->ListNews, 200);
        }


        foreach ($subcategories as $key => $category) {
            $this->searchNews($category);
        }

        return response()->json($this->ListNews, 200);

    }

}
