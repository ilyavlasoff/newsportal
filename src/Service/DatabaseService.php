<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Tag;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr\Join;

class DatabaseService
{
    protected $em;

    public function __construct(EntityManagerInterface $emi)
    {
        $this->em = $emi;
    }

    public function insert($object)
    {
        $this->em->persist($object);
        $this->em->flush();
    }

    public function getArticleList(int $offset, int $maxCount, string $sort)
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder
            ->select('a.id, a.title, a.writingTime, a.description, a.viewsCount, u.username, COUNT(c.id) as commentsCount')
            ->from('App\Entity\Article', 'a')
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'a.authorId = u.id')
            ->leftJoin('App\Entity\Comment', 'c', Join::WITH, 'c.toArticle = a.id')
            ->groupBy('a.id, u.id')
            ->setFirstResult($offset)
            ->setMaxResults($maxCount);
        if ($sort === 'newer')
        {
            $queryBuilder->orderBy('a.writingTime', 'DESC');
        }
        elseif ($sort === 'older')
        {
            $queryBuilder->orderBy('a.writingTime');
        }
        elseif ($sort === 'views')
        {
            $queryBuilder->orderBy('a.viewsCount', 'DESC');
        }
        elseif ($sort === 'discuss')
        {
            $queryBuilder->orderBy('COUNT(c.id)', 'DESC');
        }
        $query = $queryBuilder->getQuery();
        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function getArticle($id)
    {
        $article = $this->em->getRepository(Article::class)->find($id);
        if (! $article)
        {
            throw new \Exception('Article not found');
        }
        return $article;
    }

    public function deleteArticle($id)
    {
        $article = $this->getArticle($id);
        $this->em->remove($article);
        $this->em->flush();
    }

    public function incrementVisitCounter(Article $article)
    {
        $visitCount = $article->getViewsCount();
        $article->setViewsCount(++$visitCount);
        $this->em->flush();
    }

    public function getTotalArticlesCount()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder
            ->select('COUNT(a.id) as count')
            ->from('App\Entity\Article', 'a');
        $query = $queryBuilder->getQuery();
        return $query->getScalarResult();
    }

    public function editComment($id, string $text)
    {
        $comment = $this->em->getRepository(Comment::class)->find($id);
        if (! $comment)
        {
            throw new \Exception('Comment not found');
        }
        $comment->setContent($text);
        $comment->setAddedTime(new \DateTime());
        $this->em->flush();
    }

    public function deleteComment($id)
    {
        $comment = $this->em->getRepository(Comment::class)->find($id);
        if (! $comment)
        {
            throw new \Exception('Comment not found');
        }
        $this->em->remove($comment);
        $this->em->flush();
    }

    public function getComments(Article $article, int $count, int $offset): ?array
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder
            ->select('c.id, c.addedTime, c.content, u.id as userId, u.username, u.userPic')
            ->from('App\Entity\Comment', 'c')
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'c.writtenBy = u.id')
            ->where('c.toArticle = :article')
            ->setParameter('article', $article->getId())
            ->setMaxResults($count)
            ->setFirstResult($offset)
            ->orderBy('c.addedTime', 'desc');
        $query = $queryBuilder->getQuery();
        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function addComment(string $content, Article $article, User $user): ?int
    {
        $comment = new Comment();
        $comment->setAddedTime(new \DateTime());
        $comment->setContent($content);
        $comment->setToArticle($article);
        $comment->setWrittenBy($user);
        $this->em->persist($comment);
        $this->em->flush();
        return $comment->getId();
    }
}