<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Models\Article;
use App\Validators\ArticlesValidator;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticlesController extends Controller
{
    /**
     * Lista todos os artigos
     *
     * @response
     * {
     *  "data": [
     *  {
     *    "id": 1,
     *     "title": "NASA Selects Four University Teams for Aviation Projects",
     *     "url": "http://www.nasa.gov/press-release/nasa-selects-four-university-teams-for-aviation-projects",
     *     "imageUrl": "https://www.nasa.gov/sites/default/files/thumbnails/image/university-concept.jpg?itok=HPhDA6V-",
     *     "newsSite": "NASA",
     *"     summary": "NASA’s research focus on sustainable aviation will get some big help from teams of university
     * faculty and students recently selected to participate in the agency’s University Leadership Initiative (ULI).",
     *      "featured": false,
     *      "launches": [],
     *      "events": [],
     *      "publishedAt": "2021-12-23T19:06:00.000000Z",
     *      "updatedAt": "2021-12-23T19:06:55.000000Z"
     *   }
     * ],
     * "links": {
     *   "first": "http://laravel-backend-challenge.test/articles?page=1",
     *   "last": "http://laravel-backend-challenge.test/articles?page=1",
     *   "prev": null,
     *   "next": null
     *  },
     *  "meta": {
     *   "current_page": 1,
     *   "from": 1,
     *   "last_page": 1,
     *   "links": [
     *      {
     *         "url": null,
     *        "label": "&laquo; Previous",
     *        "active": false
     *      },
     *      {
     *      "url": "http://laravel-backend-challenge.test/articles?page=1",
     *      "label": "1",
     *      "active": true
     *     },
     *     {
     *      "url": null,
     *      "label": "Next &raquo;",
     *      "active": false
     *      }
     *   ],
     *     "path": "http://laravel-backend-challenge.test/articles",
     *     "per_page": 15,
     *     "to": 1,
     *     "total": 1
     *    }
     * }
     *
     * @group Artigos
     *
     * @return ArticleResource
     */
    public function index()
    {
        $articles = Article::paginate();

        return ArticleResource::collection($articles);
    }

    /**
     * Adiciona um novo artigo
     *
     * @group Artigos
     *
     * @bodyParam title string required The title of the article.
     * @bodyParam url string required The url of the article.
     * @bodyParam imageUrl string required The image url of the article.
     * @bodyParam newsSite string required The news site of the article.
     * @bodyParam summary string required The summary of the article.
     * @bodyParam featured boolean required The featured of the article.
     * @bodyParam launches array required The launches of the article.
     * @bodyParam events array required The events of the article.
     *
     * @response 201 {
     * {
     *    "data": {
     *        "title": "omnis",
     *         "url": "occaecati",
     *         "imageUrl": "est",
     *        "newsSite": "et",
     *         "summary": "omnis",
     *         "featured": true,
     *         "publishedAt": "2021-12-25T13:16:00.000000Z",
     *        "updatedAt": "2021-12-25T19:01:28.000000Z",
     *        "id": 17
     *    }
     *  }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *        "errors": {
     *            "title": [
     *                "The title field is required."
     *           ],
     *            "url": [
     *               "The url field is required."
     *            ],
     *            "imageUrl": [
     *               "The image url field is required."
     *            ],
     *           "newsSite": [
     *                 "The news site field is required."
     *           ],
     *            "summary": [
     *               "The summary field is required."
     *          ],
     *           "featured": [
     *              "The featured field is required."
     *         ]
     *     }
     * }
     *
     * @param Request $request
     * @return ArticleResource
     */
    public function store(Request $request)
    {
        $data = (new ArticlesValidator())->validate(
            $request->all(),
            $article = new Article()
        );

        return new ArticleResource(tap($article, function ($article) use ($data) {
            return $article->fill($data)->save();
        }));
    }

    /**
     * Obter um único artigo
     *
     * @group Artigos
     *
     * @response 200 {
     *    "data": {
     *        "title": "omnis",
     *         "url": "occaecati",
     *         "imageUrl": "est",
     *        "newsSite": "et",
     *         "summary": "omnis",
     *         "featured": true,
     *         "publishedAt": "2021-12-25T13:16:00.000000Z",
     *        "updatedAt": "2021-12-25T19:01:28.000000Z",
     *        "id": 17
     *    }
     *  }
     *
     * @response 404 {
     *  "message": "Resource not found!"
     * }
     *
     * @param Article $article
     * @return ArticleResource
     */
    public function show(Article $article)
    {
        return new ArticleResource($article);
    }

    /**
     * Atualiza um único artigo
     *
     * @group Artigos
     *
     * @bodyParam title string required The title of the article.
     * @bodyParam url string required The url of the article.
     * @bodyParam imageUrl string required The image url of the article.
     * @bodyParam newsSite string required The news site of the article.
     * @bodyParam summary string required The summary of the article.
     * @bodyParam featured boolean required The featured of the article.
     * @bodyParam launches array required The launches of the article.
     * @bodyParam events array required The events of the article.
     *
     * @response 200 {
     *    "data": {
     *       "id": 10
     *        "title": "omnis",
     *         "url": "occaecati",
     *         "imageUrl": "est",
     *         "newsSite": "et",
     *         "summary": "omnis",
     *         "featured": true,
     *         "publishedAt": "2021-12-25T13:16:00.000000Z",
     *         "updatedAt": "2021-12-25T19:01:28.000000Z",
     *    }
     *  }
     *
     * @response 404 {
     *  "message": "Resource not found!"
     * }
     *
     * @response 422 {
     *   "message": "The given data was invalid.",
     *        "errors": {
     *            "title": [
     *                "The title field is required."
     *           ],
     *            "url": [
     *               "The url field is required."
     *            ],
     *            "imageUrl": [
     *               "The image url field is required."
     *            ],
     *           "newsSite": [
     *                 "The news site field is required."
     *           ],
     *            "summary": [
     *               "The summary field is required."
     *          ],
     *           "featured": [
     *              "The featured field is required."
     *         ]
     *     }
     * }
     *
     * @param Request $request
     * @param Article $article
     * @return ArticleResource
     */
    public function update(Request $request, Article $article)
    {
        $data = (new ArticlesValidator())->validate(
            $request->all(),
            $article
        );

        return new ArticleResource(tap($article, function ($article) use ($data) {
            return $article->fill($data)->save();
        }));
    }

    /**
     * Deleta um artigo
     *
     * @param Article $article
     *
     * @group Artigos
     *
     * @response {
     *   "message": "Artigo deletado!"
     * }
     *
     * @response 404 {
     *  "message": "Resource not found!"
     * }
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return response(['message' => 'Artigo deletado!'], Response::HTTP_OK);
    }
}
