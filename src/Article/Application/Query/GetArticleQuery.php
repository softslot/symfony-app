<?php

declare(strict_types=1);

namespace App\Article\Application\Query;

use App\Shared\Application\Query\QueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class GetArticleQuery implements QueryInterface
{
    public function __construct(
        #[Assert\Uuid]
        public string $id,
    ) {
    }
}
