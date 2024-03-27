<?php

namespace App\Traits;

use App\Models\Article;
use Carbon\Carbon;

trait ParseArticle {
    public static function parseArticleFromArray(array $data): Article
    {
        $article = new Article();

        $article->title = $data['title'] ?? '';
        $article->description = $data['description'] ?? '';
        $article->url = $data['url'] ?? '';
        $article->url_to_image = $data['urlToImage'] ?? '';
        $article->published_at = Carbon::parse($data['publishedAt'] ?? '')->format('Y-m-d H:i:s');
        $article->content = $data['content'] ?? '';

        return $article;
    }
}