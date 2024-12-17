<?php

namespace App\Controller;

use App\Entity\PhpFunction;
use App\Repository\CategoryRepository;
use App\Repository\PhpFunctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardTrainingFunctionController extends AbstractController
{
    #[Route('/dashboard/training/function', name: 'training_function')]
    public function index(CategoryRepository $categoryRepository, PhpFunctionRepository $phpFunctionRepository): Response
    {
        $category = $categoryRepository->findOneBy(['name' => 'string']);
        $functions = $phpFunctionRepository->findBy(['category' => $category]);

        //Récupération de 6 fonctions aléatoires
        if (count($functions) > 6) {
            shuffle($functions);
            $functions = array_slice($functions, 0, 6);
        }

        //Récupération des noms et des définitions dans deux tableaux distincts
        $functionsName = [];
        $functionsDefinition = [];

        foreach($functions as $function) {
            $id = $function->getId();
            $functionsName[$id] = $function->getName();
            $functionsDefinition[$id]= $function->getDefinition();
        }

        // Mélanger tout en gardant les clés associatives
        function shuffle_assoc($array) {
            $keys = array_keys($array);
            shuffle($keys);

            $shuffled = [];
            foreach ($keys as $key) {
                $shuffled[$key] = $array[$key];
            }

            return $shuffled;
        }

        $functionsName = shuffle_assoc($functionsName);
        $functionsDefinition = shuffle_assoc($functionsDefinition);

        return $this->render('training_function/index.html.twig', [
            'functionsName' => $functionsName,
            'functionsDefinition' => $functionsDefinition,
        ]);
    }
}
