<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends BaseController
{
    #[Route(path: '/', name: 'home', methods: ['GET'])]
    public function main(): Response
    {
        return $this->render('home.html.twig');
    }
}
