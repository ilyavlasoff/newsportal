<?php

namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticlesListController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $dbService)
    {
        $this->databaseOperator = $dbService;
    }

    public function getArticleList(Request $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $maxCount = $request->request->get('count');
            $offset = $request->request->get('offset');

            try
            {
                $articlesList = $this->databaseOperator->getArticleList($offset, $maxCount);
                $totalCount = $this->databaseOperator->getTotalArticlesCount()[0]['count'];
            }
            catch (\Exception $ex)
            {

            }
            return new JsonResponse(json_encode([
                'total' => $totalCount,
                'loaded' => count($articlesList),
                'content' => $articlesList
            ]));
        }
        else {
            $articlesList = $this->databaseOperator->getArticleList(0, 10);
            return $this->render('pages/feed.html.twig', [
                'articles' => $articlesList
            ]);
        }
    }

    public function displayPage()
    {
        $articlesList = $this->databaseOperator->getArticleList(0, 10);
        return $this->render('pages/feed.html.twig', [
            'articles' => $articlesList
        ]);
    }
}