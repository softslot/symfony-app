<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Form;

use App\Article\Application\Command\EditArticleCommand;
use App\Article\Domain\Entity\Article\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditArticleForm extends AbstractType implements DataMapperInterface
{
    private ?Article $article = null;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->article = $options['article'];
        $builder->setDataMapper($this);

        $builder
            ->add('title', TextType::class)
            ->add('content', TextareaType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired(['article']);
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
        $forms = iterator_to_array($forms);

        $forms['title']->setData($this->article?->getTitle());
        $forms['content']->setData($this->article?->getContent());
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        if ($this->article === null) {
            return;
        }

        $forms = iterator_to_array($forms);

        $viewData = new EditArticleCommand(
            $this->article->getId(),
            $forms['title']->getData(),
            $forms['content']->getData(),
        );
    }
}
