<?php

namespace App\Controller;

use App\Entity\PhpFunction;
use App\Repository\CategoryRepository;
use App\Repository\PhpFunctionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TrainingFunctionController extends AbstractController
{
    #[Route('/training/function', name: 'training_function')]
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

        // Récupération d'une fonction aléatoire et de ses informations
        $uniqueFunction = $functions[0];
        $functionExample = $uniqueFunction->getExemple();
        $functionName = $uniqueFunction->getName();
        $functionId = $uniqueFunction->getId();

        // Retrait des parenthèses et remplacement du nom de la fonction dans l'exemple
        $nameWithoutParenthesis = str_replace('()', '', $functionName);
        $gameExample = str_replace($nameWithoutParenthesis, '_________', $functionExample);

        // Reformater l'exemple de code
        $formattedGameExample = str_replace(
            ['<?php ', ' ?>', ';  ', '//'],
            ["<?php\n    ", "\n?>", ";\n", "    //"],
            $gameExample
        );

        // Création d'un tableau avec 4 noms de fonction, dont celle sélectionnée
        $functionsNameChoice = [$uniqueFunction->getId() => $functionName];

        $functionsChoice = array_slice($functions, 0, 4);

        foreach ($functionsChoice as $function) {
            $functionsNameChoice[$function->getId()] = $function->getName();
        }

        // Mélange des éléments du tableau tout en conservant les clés
        $keys = array_keys($functionsNameChoice);
        shuffle($keys);

        $shuffledFunctions = [];
        foreach ($keys as $key) {
            $shuffledFunctions[$key] = $functionsNameChoice[$key];
        }

        // Passer le tableau mélangé à Twig
        $functionsNameChoice = $shuffledFunctions;

        return $this->render('training_function/index.html.twig', [
            'functions' => $functions,
            'functionsName' => $functionsName,
            'functionsDefinition' => $functionsDefinition,
            'uniqueFunction' => $uniqueFunction,
            'functionId' => $functionId,
            'formattedGameExample' => $formattedGameExample,
            'gameExample' => $gameExample,
            'functionsNameChoice' => $functionsNameChoice,
            'nameWithoutParenthesis' => $nameWithoutParenthesis,
        ]);
    }
}
