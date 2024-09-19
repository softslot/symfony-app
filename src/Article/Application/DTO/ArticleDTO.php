<?php

declare(strict_types=1);

namespace App\Article\Application\DTO;

readonly class ArticleDTO
{
    public function __construct(
        public int $id,
        public string $title,
        public string $content,
    ) {
    }
}
