<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class BaseController extends AbstractController
{
    protected function addSuccessFlash(string $message): void
    {
        $this->addFlash('success', $message);
    }

    protected function addErrorFlash(string $message): void
    {
        $this->addFlash('error', $message);
    }
}
