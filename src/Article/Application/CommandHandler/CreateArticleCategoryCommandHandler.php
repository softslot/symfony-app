<?php

declare(strict_types=1);

namespace App\Article\Application\CommandHandler;

use App\Article\Application\Command\CreateArticleCategoryCommand;
use App\Article\Domain\Entity\ArticleCategory\ArticleCategory;
use App\Article\Domain\Entity\ArticleCategory\ArticleCategoryId;
use App\Article\Infrastructure\Doctrine\Repository\ArticleCategoryRepository;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateArticleCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private ArticleCategoryRepository $articleCategoryRepository,
    ) {
    }

    public function __invoke(CreateArticleCategoryCommand $command): void
    {
        if ($command->title === 'not') {
            throw new \DomainException('title is duplicate');
        }

        $articleCategory = new ArticleCategory(
            new ArticleCategoryId($command->id),
            $command->title,
        );

        $this->articleCategoryRepository->save($articleCategory);
    }
}
