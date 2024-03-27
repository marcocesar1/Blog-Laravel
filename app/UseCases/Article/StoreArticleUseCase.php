<?php

namespace App\UseCases\Article;

use App\Models\Article;
use App\Models\User;

use App\Services\UsersService;
use App\Services\ArticlesService;

use Illuminate\Support\Facades\DB;

use Exception;

class StoreArticleUseCase
{
    public function __construct(
        private UsersService $usersService,
        private ArticlesService $articlesService,
    ) {}

    public function execute(string $query)
    {
        try {
            DB::beginTransaction();
        
            $article = $this->getArticle($query);
            $author = $this->getAuthor();

            $storedArticle = $this->storeArticle($article, $author);

            DB::commit();

            return $storedArticle;
        } catch (Exception $e) {
            DB::rollBack();

            throw new Exception($e->getMessage());
        }
    }

    public function getArticle(string $query): Article
    {
        $response = $this->articlesService->getArticles($query);

        $articles = $response['articles'] ?? [];

        if(!count($articles)) throw new Exception('No articles found');

        $post = Article::parseArticleFromArray($articles[0]);

        return $post;
    }

    public function getAuthor(): User
    {
        $response = $this->usersService->getUser();
        
        $users = $response['results'] ?? [];

        if(!count($users)) throw new Exception('No users found');

        $user = User::parseUserFromArray($users[0]);

        $user->save();

        return $user;
    }

    private function storeArticle(Article $article, User $author)
    {
        $article->user_id = $author->id;
        $article->save();

        $article->load('author');
        
        return $article;
    }
}

