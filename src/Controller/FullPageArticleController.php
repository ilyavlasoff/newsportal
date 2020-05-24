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
        $authorId = $article->getAuthorId();

        if (!$this->getUser() || $this->getUser()->getId() !== $authorId->getId())
        {
            $this->databaseOperator->incrementVisitCounter($article);
        }

        return $this->render('pages/article_full_view.html.twig', [
           'article' => $article
        ]);
    }
}