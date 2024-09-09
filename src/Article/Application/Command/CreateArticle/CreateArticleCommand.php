<?php

declare(strict_types=1);

namespace App\Article\Application\Command\CreateArticle;

readonly class CreateArticleCommand
{
    public function __construct(
        public string $title,
        public string $content,
    ) {
    }
}
