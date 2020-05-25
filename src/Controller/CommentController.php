<?php

namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CommentController extends AbstractController
{
    private $databaseOperator;

    public function __construct(DatabaseService $databaseOperator)
    {
        $this->databaseOperator = $databaseOperator;
    }

    public function getCommentList(Request $request, string $id)
    {
        $count = $request->request->get('count');
        $offset = $request->request->get('offset');

        if ($count === null || !is_numeric($count) || $offset === null || !is_numeric($offset))
        {
            return new JsonResponse(json_encode(['error' => 'Invalid request']), Response::HTTP_BAD_REQUEST);
        }

        $article = $this->databaseOperator->getArticle(htmlentities($id));
        $comments = $this->databaseOperator->getComments($article, htmlentities($count), htmlentities($offset));

        return new JsonResponse(json_encode(['count' => count($comments),'comments' => $comments]));
    }

    public function addComment(Request $request, string $id)
    {
        $content = $request->request->get('content');
        $user = $this->getUser();

        if (! ($content && $user))
        {
            return new JsonResponse(json_encode(['error' => 'Invalid request']), Response::HTTP_BAD_REQUEST);
        }

        try
        {
            $article = $this->databaseOperator->getArticle($id);
            $commentId = $this->databaseOperator->addComment(htmlentities($content), $article, $user);
        }
        catch (\Exception $ex)
        {
            return new JsonResponse(json_encode(['added' => false, 'error' => $ex->getMessage()]), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(json_encode(['added' => true, 'id' => $commentId]));
    }

    public function editComment(Request $request)
    {
        $content = $request->request->get('content');
        $id = $request->request->get('id');
        $user = $this->getUser();

        if (! ($content && $id && $user))
        {
            return new JsonResponse(json_encode(['error' => 'Invalid request']), Response::HTTP_BAD_REQUEST);
        }

        try
        {
            $this->databaseOperator->editComment(htmlentities($id), htmlentities($content));
        }
        catch (\Exception $ex)
        {
            return new JsonResponse(json_encode(['edited' => false, 'error' => $ex->getMessage()]), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(json_encode(['edited' => true]));
    }

    public function deleteComment(Request $request)
    {
        $id = $request->request->get('id');
        $user = $this->getUser();

        if (! ($id && $user))
        {
            return new JsonResponse(json_encode(['error' => 'Invalid request']), Response::HTTP_BAD_REQUEST);
        }

        try
        {
            $this->databaseOperator->deleteComment(htmlentities($id));
        }
        catch (\Exception $ex)
        {
            return new JsonResponse(json_encode(['deleted' => false, 'error' => $ex->getMessage()]), Response::HTTP_NOT_FOUND);
        }

        return new JsonResponse(json_encode(['deleted' => true]));
    }
}