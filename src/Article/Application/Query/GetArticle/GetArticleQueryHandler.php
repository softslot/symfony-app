<?php

declare(strict_types=1);

namespace App\Article\Application\Query\GetArticle;

use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use App\Shared\Application\Query\QueryHandlerInterface;
use Doctrine\ORM\EntityNotFoundException;

readonly class GetArticleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private ArticleRepository $articleRepository,
    ) {
    }

    public function __invoke(GetArticleQuery $query): string
    {
        $article = $this->articleRepository->find($query->id)
            ?? throw new EntityNotFoundException();

        return $article->getTitle();
    }
}
