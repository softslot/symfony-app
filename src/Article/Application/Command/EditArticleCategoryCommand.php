<?php

declare(strict_types=1);

namespace App\Article\Application\Command;

use App\Article\Infrastructure\Validator\ArticleExist;
use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

readonly class EditArticleCategoryCommand implements CommandInterface
{
    public function __construct(
        #[ArticleExist]
        #[Assert\Uuid]
        public string $id,
        #[Assert\Length(min: 3)]
        public string $title,
    ) {
    }
}
