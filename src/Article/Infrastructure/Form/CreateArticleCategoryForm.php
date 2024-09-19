<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Form;

use App\Article\Application\Command\CreateArticleCategoryCommand;
use App\Article\Domain\Entity\Article\ArticleId;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateArticleCategoryForm extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->setDataMapper($this);

        $builder
            ->add('title', TextType::class)
        ;
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        $forms = iterator_to_array($forms);

        $viewData = new CreateArticleCategoryCommand(
            ArticleId::next(),
            $forms['title']->getData(),
        );
    }
}
