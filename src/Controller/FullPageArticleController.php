<?php

namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FullPageArticleController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $databaseService)
    {
        $this->databaseOperator = $databaseService;
    }

    public function displayPage(string $id)
    {
        $article = $this->databaseOperator->getArticle($id);

        return $this->render('pages/article_full_view.html.twig', [
           'article' => $article
        ]);
    }
}