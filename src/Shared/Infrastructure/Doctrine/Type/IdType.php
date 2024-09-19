<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Doctrine\Type;

use App\Article\Domain\Entity\Article\ArticleId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IdType extends GuidType
{
    public function convertToDatabaseValue($value, AbstractPlatform $platform): string
    {
        return $value instanceof ArticleId ? $value->getValue() : $value;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ?ArticleId
    {
        return !empty($value) ? new ArticleId($value) : null;
    }
}
