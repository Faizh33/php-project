<?php

namespace App\Controller;

use App\Entity\PhpFunction;
use App\Repository\PhpFunctionRepository;
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

    #[Route('/php-functions/list', name: 'php_functions_list')]
    public function list(PhpFunctionRepository $phpFunctionRepository): Response
    {
        $stringFunctions = $phpFunctionRepository->findByCategoryName('string');
        $arrayFunctions = $phpFunctionRepository->findByCategoryName('array');
        $fileFunctions = $phpFunctionRepository->findByCategoryName('file');
        $dateFunctions = $phpFunctionRepository->findByCategoryName('date');
        $mathsFunctions = $phpFunctionRepository->findByCategoryName('maths');
        $errorFunctions = $phpFunctionRepository->findByCategoryName('error');
        $jsonFunctions = $phpFunctionRepository->findByCategoryName('json');
        $objectFunctions = $phpFunctionRepository->findByCategoryName('object');
        $variableFunctions = $phpFunctionRepository->findByCategoryName('variable');
        $xmlFunctions = $phpFunctionRepository->findByCategoryName('xml');
        $mysqlFunctions = $phpFunctionRepository->findByCategoryName('mysql');
        $cryptographyFunctions = $phpFunctionRepository->findByCategoryName('cryptography');
        $curlFunctions = $phpFunctionRepository->findByCategoryName('curl');
        $typeFunctions = $phpFunctionRepository->findByCategoryName('type');
        $headersHttpFunctions = $phpFunctionRepository->findByCategoryName('headers_http');
        $redFunctions = $phpFunctionRepository->findByCategoryName('red');

        return $this->render('php_function/functions-list.html.twig', [
            'stringFunctions' => $stringFunctions,
            'arrayFunctions' => $arrayFunctions,
            'fileFunctions' => $fileFunctions,
            'dateFunctions' => $dateFunctions,
            'mathsFunctions' => $mathsFunctions,
            'errorFunctions' => $errorFunctions,
            'jsonFunctions' => $jsonFunctions,
            'objectFunctions' => $objectFunctions,
            'variableFunctions' => $variableFunctions,
            'xmlFunctions' => $xmlFunctions,
            'mysqlFunctions' => $mysqlFunctions,
            'cryptographyFunctions' => $cryptographyFunctions,
            'curlFunctions' => $curlFunctions,
            'typeFunctions' => $typeFunctions,
            'headersHttpFunctions' => $headersHttpFunctions,
            'redFunctions' => $redFunctions,
        ]);
    }
}