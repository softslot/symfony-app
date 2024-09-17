<?php

declare(strict_types=1);

namespace App\Article\Application\Command\CreateArticle;

use App\Article\Domain\Entity\Article\Article;
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
        $article = new Article($command->title, $command->content);

        $this->articleRepository->save($article);
    }
}
