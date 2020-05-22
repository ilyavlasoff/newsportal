<?php

namespace App\Service;

use App\Entity\Article;
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

    public function getArticleList(int $offset, int $maxCount)
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder
            ->select('a.id, a.title, a.writingTime, a.description, a.viewsCount, u.username, COUNT(c.id) as commentsCount')
            ->from('App\Entity\Article', 'a')
            ->innerJoin('App\Entity\User', 'u', Join::WITH, 'a.authorId = u.id')
            ->leftJoin('App\Entity\Comment', 'c', Join::WITH, 'c.toArticle = a.id')
            ->groupBy('a.id, u.id')
            ->orderBy('a.writingTime')
            ->setFirstResult($offset)
            ->setMaxResults($maxCount);
        $query = $queryBuilder->getQuery();
        return $query->getResult(Query::HYDRATE_ARRAY);
    }

    public function getTagsToArticle(Article $article)
    {

    }
}