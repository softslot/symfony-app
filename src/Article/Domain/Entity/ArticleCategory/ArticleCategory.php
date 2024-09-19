<?php

declare(strict_types=1);

namespace App\Article\Domain\Entity\ArticleCategory;

use App\Article\Infrastructure\Doctrine\Repository\ArticleCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleCategoryRepository::class)]
#[ORM\Table(name: '`article_categories`')]
class ArticleCategory
{
    #[ORM\Embedded(class: ArticleCategoryId::class, columnPrefix: false)]
    private ArticleCategoryId $id;

    #[ORM\Column(name: 'title', length: 255, nullable: false)]
    private string $title;

    public function __construct(
        ArticleCategoryId $id,
        string $title,
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    public function getId(): string
    {
        return $this->id->getValue();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
