<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AddArticleFormType;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class AddArticleController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $databaseOperator)
    {
        $this->databaseOperator = $databaseOperator;
    }

    public function displayPage(Request $request)
    {
        $article = new Article();
        $addArticleForm = $this->createForm(AddArticleFormType::class, $article);
        $addArticleForm->handleRequest($request);

        if ($addArticleForm->isSubmitted() && $addArticleForm->isValid())
        {
            $article->setAuthorId($this->getUser());
            $article->setWritingTime(new \DateTime());
            $article->setViewsCount(0);
            if (!$article->getDescription()) {
                $content = $article->getContent();
                $description = substr($content, 0, 512);
                $article->setDescription($description);
            }
            $this->databaseOperator->insert($article);
            return new RedirectResponse($this->generateUrl('article_page', ['id' => $article->getId()]));
        }

        return $this->render('pages/add_article_page.html.twig', [
            'addArticleForm' => $addArticleForm->createView()
        ]);
    }
}