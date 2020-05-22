<?php

namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StartpageController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $dbService)
    {
        $this->databaseOperator = $dbService;
    }

    public function display()
    {
        $articlesList = $this->databaseOperator->getArticleList(0, 10);
        return $this->render('pages/feed.html.twig', [
            'articles' => $articlesList
        ]);
    }
}