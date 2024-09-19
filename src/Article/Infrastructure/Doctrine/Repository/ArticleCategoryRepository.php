<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Doctrine\Repository;

use App\Article\Domain\Entity\ArticleCategory\ArticleCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleCategory>
 */
class ArticleCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleCategory::class);
    }

    public function save(ArticleCategory $article): void
    {
        $this->getEntityManager()->persist($article);
        $this->getEntityManager()->flush();
    }
}
