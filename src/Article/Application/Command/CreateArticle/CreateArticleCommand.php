<?php

declare(strict_types=1);

namespace App\Article\Application\Command\CreateArticle;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class CreateArticleCommand implements CommandInterface
{
    public function __construct(
        #[Assert\Length(min: 10)]
        public string $title,
        public string $content,
    ) {
    }
}
