<?php

declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends BaseController
{
    #[Route(path: '/', name: 'index', methods: ['GET'])]
    public function main(): Response
    {
        return $this->render('main.html.twig');
    }
}
