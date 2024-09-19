<?php

declare(strict_types=1);

namespace App\Article\Application\CommandHandler;

use App\Article\Application\Command\EditArticleCategoryCommand;
use App\Article\Infrastructure\Doctrine\Repository\ArticleCategoryRepository;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class EditArticleCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleCategoryRepository $articleCategoryRepository,
    ) {
    }

    public function __invoke(EditArticleCategoryCommand $command): void
    {
        $article = $this->articleCategoryRepository->find($command->id)
            ?? throw new \Exception('Article category not found');

        $article->setTitle($command->title);
        $this->articleCategoryRepository->save($article);
    }
}
