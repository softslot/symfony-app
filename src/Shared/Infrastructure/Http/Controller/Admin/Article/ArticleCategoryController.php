<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controller\Admin\Article;

use App\Article\Application\Command\CreateArticleCategoryCommand;
use App\Article\Application\Command\EditArticleCategoryCommand;
use App\Article\Application\Query\GetArticleQuery;
use App\Article\Infrastructure\Doctrine\Repository\ArticleCategoryRepository;
use App\Article\Infrastructure\Form\CreateArticleCategoryForm;
use App\Article\Infrastructure\Form\EditArticleCategoryForm;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Http\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/article-category', name: 'admin.article_category.')]
class ArticleCategoryController extends BaseController
{
    public function __construct(
        private readonly ArticleCategoryRepository $articleCategoryRepository,
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(type: CreateArticleCategoryForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* @var CreateArticleCategoryCommand $command */
            $command = $form->getData();
            $this->commandBus->execute($command);

            $this->addSuccessFlash('Article Category Created!');

            return $this->redirectToRoute('admin.article_category.create');
        }

        return $this->render('admin/article_category/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, string $id): Response
    {
        $article = $this->articleCategoryRepository->find($id)
            ?? throw new NotFoundHttpException();

        $form = $this->createForm(type: EditArticleCategoryForm::class, options: ['article' => $article]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var EditArticleCategoryCommand $command */
            $command = $form->getData();
            $this->commandBus->execute($command);

            $this->addSuccessFlash('Article Category Updated!');
        }

        return $this->render('admin/article_category/update.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'show', methods: ['GET'])]
    public function show(string $id): Response
    {
        $article = $this->queryBus->execute(
            new GetArticleQuery($id)
        );

        if ($article === null) {
            $this->createNotFoundException();
        }

        return $this->render('admin/article_category/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route(path: '', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('admin/article_category/list.html.twig', [
            'articles' => [],
        ]);
    }
}
