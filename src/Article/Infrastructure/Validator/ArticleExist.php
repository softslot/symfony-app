<?php

namespace App\Article\Infrastructure\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class ArticleExist extends Constraint
{
    public string $message = 'Article with id "{{ value }}" not found.';
}
