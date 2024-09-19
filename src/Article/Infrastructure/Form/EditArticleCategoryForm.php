<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Form;

use App\Article\Application\Command\EditArticleCategoryCommand;
use App\Article\Domain\Entity\Article\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditArticleCategoryForm extends AbstractType implements DataMapperInterface
{
    private ?Article $article = null;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->article = $options['article_category2'];
        $builder->setDataMapper($this);

        $builder
            ->add('title', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['article_category']);
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        $forms = iterator_to_array($forms);

        $forms['title']->setData($this->article?->getTitle());
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        if ($this->article === null) {
            return;
        }

        $forms = iterator_to_array($forms);

        $viewData = new EditArticleCategoryCommand(
            $this->article->getId(),
            $forms['title']->getData(),
        );
    }
}
