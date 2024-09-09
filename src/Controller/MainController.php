<?php

declare(strict_types=1);

namespace App\Controller;

use App\Article\Application\Command\CreateArticle\CreateArticleCommand;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    public function __construct(
        private readonly MessageBusInterface $messageBus,
    ) {
    }

    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function main(): Response
    {
        $this->messageBus->dispatch(
            new CreateArticleCommand('new title', 'new content')
        );

        return $this->render('main.html.twig');
    }
}
