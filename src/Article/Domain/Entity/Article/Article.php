<?php

declare(strict_types=1);

namespace App\Article\Domain\Entity\Article;

use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: '`article_articles`')]
class Article
{
    #[ORM\Embedded(class: ArticleId::class, columnPrefix: false)]
    private ArticleId $id;

    #[ORM\Column(name: 'title', length: 255, nullable: false)]
    private string $title;

    #[ORM\Column(name: 'content', nullable: false)]
    private string $content;

    public function __construct(
        ArticleId $id,
        string $title,
        string $content,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
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

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void
    {
        $this->content = $content;
    }
}
