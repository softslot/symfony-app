<?php

declare(strict_types=1);

namespace App\Article\Infrastructure\Form;

use App\Article\Application\Command\CreateArticleCommand;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateArticleForm extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->setDataMapper($this);

        $builder
            ->add('title', TextType::class, [
                'label' => 'Title',
                'help' => 'Title',
            ])
            ->add('content')
        ;
    }

    public function mapDataToForms(mixed $viewData, \Traversable $forms): void
    {
    }

    public function mapFormsToData(\Traversable $forms, mixed &$viewData): void
    {
        $forms = iterator_to_array($forms);

        $viewData = new CreateArticleCommand(
            $forms['title']->getData(),
            $forms['content']->getData(),
        );
    }
}
