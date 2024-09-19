<?php

declare(strict_types=1);

namespace App\Article\Application\CommandHandler;

use App\Article\Application\Command\CreateArticleCommand;
use App\Article\Domain\Entity\Article\Article;
use App\Article\Domain\Entity\Article\ArticleId;
use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleRepository $articleRepository,
    ) {
    }

    public function __invoke(CreateArticleCommand $command): void
    {
        if ($command->title === 'not') {
            throw new \DomainException('title is duplicate');
        }

        $article = new Article(
            new ArticleId($command->id),
            $command->title,
            $command->content,
        );

        $this->articleRepository->save($article);
    }
}
