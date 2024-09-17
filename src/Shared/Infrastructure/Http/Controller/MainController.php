<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controller;

use App\Article\Application\Command\CreateArticle\CreateArticleCommand;
use App\Article\Application\Query\GetArticle\GetArticleQuery;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
    ) {
    }

    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function main(): Response
    {
        $command = new CreateArticleCommand('foo', 'bar');
        $this->commandBus->execute($command);

        $query = new GetArticleQuery(1);
        $title = $this->queryBus->execute($query);

        return $this->render('main.html.twig');
    }
}
