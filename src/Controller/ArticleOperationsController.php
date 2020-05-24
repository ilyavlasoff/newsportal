<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\AddArticleFormType;
use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleOperationsController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $databaseOperator)
    {
        $this->databaseOperator = $databaseOperator;
    }

    private function handleForm($article)
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

    public function deleteArticle(Request $request, $id)
    {
        if ($request->isXmlHttpRequest())
        {
            try
            {
                $this->databaseOperator->deleteArticle($id);
            }
            catch (\Exception $ex)
            {
                return new JsonResponse(json_encode(['deleted' => false, 'error' => $ex->getMessage()]), Response::HTTP_INTERNAL_SERVER_ERROR);
            }
            return new JsonResponse(json_encode(['deleted' => true]), Response::HTTP_OK);
        }
        else {
            return new JsonResponse(json_encode(['deleted' => false]), Response::HTTP_BAD_REQUEST);
        }
    }

    public function editArticle(Request $request, string $id)
    {
        try
        {
            $article = $this->databaseOperator->getArticle($id);
            $firstPublishTime = $article->getWritingTime();
            $viewsCount = $article->getViewsCount();
        }
        catch (\Exception $ex)
        {
            return new RedirectResponse('add_article_page');
        }
        $addArticleForm = $this->createForm(AddArticleFormType::class, $article);
        $addArticleForm->handleRequest($request);
        if ($addArticleForm->isSubmitted() && $addArticleForm->isValid())
        {
            return $this->handleForm($article);
        }

        return $this->render('pages/add_article_page.html.twig', [
            'addArticleForm' => $addArticleForm->createView(),
            'title' => 'Edit article',
            'edited' => true,
            'firstPublishtime' => $firstPublishTime,
            'viewsCount' => $viewsCount
        ]);
    }

    public function addArticle(Request $request)
    {
        $article = new Article();
        $addArticleForm = $this->createForm(AddArticleFormType::class, $article);
        $addArticleForm->handleRequest($request);

        if ($addArticleForm->isSubmitted() && $addArticleForm->isValid())
        {
            return $this->handleForm($article);
        }

        return $this->render('pages/add_article_page.html.twig', [
            'addArticleForm' => $addArticleForm->createView(),
            'title' => 'Add an article',
            'edited' => false
        ]);
    }
}