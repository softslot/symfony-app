<?php

declare(strict_types=1);

namespace App\Article\Application\Command;

use App\Shared\Application\Command\CommandInterface;
use Symfony\Component\Validator\Constraints as Assert;

class CreateArticleCategoryCommand implements CommandInterface
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Uuid]
        public string $id,
        #[Assert\NotBlank]
        public string $title,
    ) {
    }
}
