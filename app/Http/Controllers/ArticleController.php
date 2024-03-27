<?php

namespace App\Http\Controllers;

use App\Models\Article;

use App\UseCases\Article\StoreArticleUseCase;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('author')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10);

        return response()->json($articles, Response::HTTP_OK);
    }

    public function store(Request $request, StoreArticleUseCase $usecase)
    {
        try {
            $request->validate([
                'query' => 'required'
            ]);

            $article = $usecase->execute($request->get('query'));

            return response()->json($article, Response::HTTP_OK);
        } catch (Exception $e) {
            $resp = [ 'message' => $e->getMessage() ];

            return response()->json($resp, Response::HTTP_BAD_REQUEST);
        }
    }
}
