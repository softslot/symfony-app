<?php

declare(strict_types=1);

namespace App\Article\Application\Command;

use App\Article\Infrastructure\Validator\ArticleExist;
use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class EditArticleCommand implements CommandInterface
{
    public function __construct(
        #[ArticleExist]
        public int $id,
        #[Assert\Length(min: 3)]
        public string $title,
        #[Assert\Length(min: 10)]
        public string $content,
    ) {
    }
}
