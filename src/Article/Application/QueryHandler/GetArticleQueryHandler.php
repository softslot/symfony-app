<?php

declare(strict_types=1);

namespace App\Article\Application\QueryHandler;

use App\Article\Application\DTO\ArticleDTO;
use App\Article\Application\Query\GetArticleQuery;
use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use App\Shared\Application\Query\QueryHandlerInterface;
use Doctrine\ORM\EntityNotFoundException;

readonly class GetArticleQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private ArticleRepository $articleRepository,
    ) {
    }

    public function __invoke(GetArticleQuery $query): ?ArticleDTO
    {
        $article = $this->articleRepository->find($query->id);
        if ($article === null) {
            return null;
        }

        return new ArticleDTO(
            $article->getId(),
            $article->getTitle(),
            $article->getContent(),
        );
    }
}
