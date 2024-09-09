<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Doctrine\Repository;

use App\Article\Domain\Entity\Article\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function save(Article $article): void
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }
}
