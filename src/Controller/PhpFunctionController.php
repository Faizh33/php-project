<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PhpFunctionController extends AbstractController
{
    #[Route('/php-functions', name: 'php_functions')]
    public function index(): Response
    {
        return $this->render('php_function/index.html.twig');
    }
}
