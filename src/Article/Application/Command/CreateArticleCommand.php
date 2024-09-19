<?php

declare(strict_types=1);

namespace App\Article\Application\Command;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateArticleCommand implements CommandInterface
{
    public function __construct(
        #[Assert\NotBlank]
        public string $title,
        #[Assert\NotBlank]
        public string $content,
    ) {
    }
}
