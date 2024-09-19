<?php

declare(strict_types=1);

namespace App\Article\Application\CommandHandler;

use App\Article\Application\Command\EditArticleCommand;
use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class EditArticleCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleRepository $articleRepository,
    ) {
    }

    public function __invoke(EditArticleCommand $command): void
    {
        $article = $this->articleRepository->find($command->id)
            ?? throw new \Exception('Article not found');

        $article->setTitle($command->title);
        $article->setContent($command->content);
        $this->articleRepository->save($article);
    }
}
