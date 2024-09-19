<?php

declare(strict_types=1);

namespace App\Article\Domain\Entity\ArticleCategory;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
class ArticleCategoryId
{
    #[ORM\Id]
    #[ORM\Column(name: 'id', type: 'id', unique: true, nullable: false)]
    private string $value;

    public function __construct(string $value)
    {
        Assert::uuid($value);
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public static function next(): string
    {
        return Uuid::uuid7()->toString();
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
