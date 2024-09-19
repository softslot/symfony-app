<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controller\Admin\Article;

use App\Article\Application\Command\CreateArticleCommand;
use App\Article\Application\Command\EditArticleCommand;
use App\Article\Application\Query\GetArticleQuery;
use App\Article\Infrastructure\Doctrine\Repository\ArticleRepository;
use App\Article\Infrastructure\Form\CreateArticleForm;
use App\Article\Infrastructure\Form\EditArticleForm;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Http\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: '/admin/article', name: 'admin.article.')]
class ArticleController extends BaseController
{
    public function __construct(
        private readonly ArticleRepository $articleRepository,
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/create', name: 'create', methods: ['GET', 'POST'])]
    public function create(Request $request): Response
    {
        $form = $this->createForm(type: CreateArticleForm::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /* @var CreateArticleCommand $command */
            $command = $form->getData();
            $this->commandBus->execute($command);

            $this->addSuccessFlash('Article Created!');

            return $this->redirectToRoute('admin.article.create');
        }

        return $this->render('admin/article/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}/edit', name: 'update', methods: ['GET', 'POST'])]
    public function update(Request $request, int $id): Response
    {
        $article = $this->articleRepository->find($id)
            ?? throw new NotFoundHttpException();

        $form = $this->createForm(type: EditArticleForm::class, options: ['article' => $article]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /* @var EditArticleCommand $command */
            $command = $form->getData();
            $this->commandBus->execute($command);

            $this->addSuccessFlash('Article Updated!');
        }

        return $this->render('admin/article/update.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }

    #[Route(path: '/{id}', name: 'show', methods: ['GET'])]
    public function show(int $id): Response
    {
        $article = $this->queryBus->execute(
            new GetArticleQuery($id)
        );

        if ($article === null) {
            $this->createNotFoundException();
        }

        return $this->render('admin/article/show.html.twig', [
            'article' => $article,
        ]);
    }

    #[Route(path: '', name: 'list', methods: ['GET'])]
    public function list(): Response
    {
        return $this->render('admin/article/list.html.twig', [
            'articles' => [],
        ]);
    }
}
