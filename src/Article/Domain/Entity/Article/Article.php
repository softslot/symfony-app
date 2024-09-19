<?php

declare(strict_types=1);

namespace App\Article\Domain\Entity\Article;

use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ORM\Table(name: '`article_articles`')]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name: 'title', length: 255, nullable: false)]
    private string $title;

    #[ORM\Column(name: 'content', nullable: false)]
    private string $content;

    public function __construct(
        string $title,
        string $content,
    ) {
        $this->title = $title;
        $this->content = $content;
    }

    public function getId(): ?int
    {
        return $this->id;
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
