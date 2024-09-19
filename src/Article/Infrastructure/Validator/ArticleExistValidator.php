<?php

namespace App\Article\Infrastructure\Validator;

use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ArticleExistValidator extends ConstraintValidator
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
    ) {
    }

    /**
     * @param ArticleExist $constraint
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value || '' === $value) {
            return;
        }

        $article = $this->articleRepository->find($value);
        if ($article !== null) {
            return;
        }

        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation();
    }
}
