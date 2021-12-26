<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Services\ArticlesService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class ArticlesCommand extends Command
{
    protected $signature = 'space-flight-articles';

    protected $description = 'Get articles from the Space Flight News API.';

    public function __construct(
        public ArticlesService $articlesService
    ) {
        parent::__construct();
    }


    public function handle()
    {
        $articles = $this->articlesService->request('articles');

        foreach ($articles as $article) {
            try {
                Article::updateOrCreate(
                    ['id' => $article['id']],
                    $article
                );
            } catch (QueryException | \PDOException | \ErrorException $e) {
                $this->error($e->getMessage());
                exit(1);
            }
        }
    }
}
