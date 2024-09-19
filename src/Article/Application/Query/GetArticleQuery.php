<?php

declare(strict_types=1);

namespace App\Article\Application\Query;

use App\Shared\Application\Query\QueryInterface;

readonly class GetArticleQuery implements QueryInterface
{
    public function __construct(
        public int $id,
    ) {
    }
}
